<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}
include("includes/db.conn.php");

// ---------------- AJAX HANDLER ----------------
if (isset($_POST['action'])) {

    // 1. Fetch students list by standard
    if ($_POST['action'] == "get_students" && !empty($_POST['std'])) {
        $std = $_POST['std'];
        $stmt = $conn->prepare("SELECT admission_id, student_name FROM stu_basic_info WHERE standard = ? ORDER BY student_name ASC");
        $stmt->bind_param("s", $std);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['admission_id']}'>{$row['student_name']}</option>";
        }
        exit;
    }

    // 2. Fetch full student details
    if ($_POST['action'] == "get_details" && !empty($_POST['adid'])) {
        $adid = $_POST['adid'];

        $stmt = $conn->prepare("SELECT admission_id, student_name, father_name, mother_name, emis_number, standard, pending_school_fee, last_year_pending_scl, pending_van_fee, last_year_pending_van, photo FROM stu_basic_info WHERE admission_id = ?");
        $stmt->bind_param("s", $adid);
        $stmt->execute();
        $stu = $stmt->get_result()->fetch_assoc();

        $pending_study = (float) $stu['pending_school_fee'];
        $pending_van = (float) $stu['pending_van_fee'];
        $last_year_school = (float) $stu['last_year_pending_scl'];
        $last_year_van = (float) $stu['last_year_pending_van'];
        $photo = !empty($stu['photo']) ? $stu['photo'] : 'assets/img/no-photo.png';

        $total_pending = $pending_study + $pending_van;
        $total_last_year_pending = $last_year_school + $last_year_van;

        echo "
    <table>
        <tr><th>Admission No</th><td>{$stu['admission_id']}</td>
            <th rowspan='12' style='vertical-align: middle; text-align: center;'>
                <img src='{$photo}' class='student-photo'>
            </th></tr>
        <tr><th>Student Name</th><td>{$stu['student_name']}</td></tr>
        <tr><th>Father Name</th><td>{$stu['father_name']}</td></tr>
        <tr><th>Mother Name</th><td>{$stu['mother_name']}</td></tr>
        <tr><th>EMIS No</th><td>{$stu['emis_number']}</td></tr>
        <tr><th>Standard</th><td>{$stu['standard']}</td></tr>
        <tr><th>Pending School Fee</th><td>{$pending_study}</td></tr>";
        // ✅ Show last year pending school fee if any
        if ($last_year_school > 0) {
            echo "<tr><th>Last Year Pending (School)</th><td>{$last_year_school}</td></tr>";
        }
        // ✅ Show van details if there is any current or last year van pending
        if ($pending_van > 0 || $last_year_van > 0) {
            if ($pending_van > 0) {
                echo "<tr><th>Pending Van Fee</th><td>{$pending_van}</td></tr>";
            }
            if ($last_year_van > 0) {
                echo "<tr><th>Last Year Pending (Van)</th><td>{$last_year_van}</td></tr>";
            }
        }
        echo "
            <tr><th>Total Pending Fee (Current Year)</th><td>{$total_pending}</td></tr>
            <tr><th>Total Pending (Including Last Year)</th><td>" . ($total_pending + $total_last_year_pending) . "</td></tr>
        </table>
        <div style='margin-top:15px;'>
            <button class='btn-pay' 
                data-adid='{$stu['admission_id']}'
                data-name='{$stu['student_name']}'
                data-std='{$stu['standard']}'
                data-pending-school='{$pending_study}'
                data-pending-van='{$pending_van}'
                data-lastyear-school='{$last_year_school}'
                data-lastyear-van='{$last_year_van}'>
                Pay Fee
            </button>
            &nbsp;&nbsp;
            <button class='btn-history'
                data-adid='{$stu['admission_id']}'>
                Show Payment History
            </button>
        </div>
        ";
        exit;
    }

    // 3. Save fee payment
    if ($_POST['action'] == "save_fee") {
        $adid = $_POST['adid'];
        $fee_type = $_POST['fee_type'];
        $payment_type = $_POST['payment_type'];
        $stu_name = $_POST['stu_name'];
        $total = $_POST['total_amount'];
        $paid = $_POST['paid_amount'];
        $paid_date = $_POST['paid_date'];

        // ✅ Server-side future date validation
        $today = date('Y-m-d');
        if ($paid_date > $today) {
            echo "error: Paid date cannot be in the future.";
            exit;
        }
    
        // ✅ Start transaction
        $conn->begin_transaction();
    
        try {
            // Generate new bill number
            $billQ = $conn->query("SELECT bill_no FROM school_expenses ORDER BY created_at DESC LIMIT 1");
            if ($billQ && $billQ->num_rows > 0) {
                $lastBill = $billQ->fetch_assoc()['bill_no'];
                $num = intval(substr($lastBill, 7)) + 1;
                $bill_no = "SMSBill" . str_pad($num, 4, "0", STR_PAD_LEFT);
            } else {
                $bill_no = "SMSBill0001";
            }
    
            // ✅ Insert into student_fees
            $stmt = $conn->prepare("INSERT INTO student_fees 
                (admission_id, bill_no, fee_type, pending_amount, paid_amount, paid_date, created_date) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("sssdds", $adid, $bill_no, $fee_type, $total, $paid, $paid_date);
            if (!$stmt->execute()) {
                throw new Exception("Error inserting student_fees: " . $stmt->error);
            }
    
            // ✅ Update stu_basic_info
            if ($fee_type == "study") {
                $check_sql = "SELECT last_year_pending_scl, pending_school_fee FROM stu_basic_info WHERE admission_id = ?";
            } else if ($fee_type == "van") {
                $check_sql = "SELECT last_year_pending_van, pending_van_fee FROM stu_basic_info WHERE admission_id = ?";
            } else {
                throw new Exception("Invalid fee type");
            }
    
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("s", $adid);
            $check_stmt->execute();
            $check_stmt->bind_result($last_year_pending, $current_pending);
            $check_stmt->fetch();
            $check_stmt->close();
    
            $pay_amount = floatval($paid);
    
            // Deduct logic
            if ($last_year_pending > 0) {
                if ($pay_amount >= $last_year_pending) {
                    $pay_amount -= $last_year_pending;
                    $last_year_pending = 0;
                } else {
                    $last_year_pending -= $pay_amount;
                    $pay_amount = 0;
                }
            }
            if ($pay_amount > 0) {
                $current_pending = max(0, $current_pending - $pay_amount);
            }
    
            if ($fee_type == "study") {
                $update_sql = "UPDATE stu_basic_info 
                    SET last_year_pending_scl = ?, pending_school_fee = ?, school_fee_pd = ? 
                    WHERE admission_id = ?";
            } else {
                $update_sql = "UPDATE stu_basic_info 
                    SET last_year_pending_van = ?, pending_van_fee = ?, van_fee_pd = ? 
                    WHERE admission_id = ?";
            }
    
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ddss", $last_year_pending, $current_pending, $paid_date, $adid);
            if (!$update_stmt->execute()) {
                throw new Exception("Error updating stu_basic_info: " . $update_stmt->error);
            }
    
            // ✅ Insert into school_expenses
            $desc = "Student Fee - " . $adid . " - " . $stu_name;
            $billtype = "Credit";
            $exp = $conn->prepare("INSERT INTO school_expenses 
                (bill_no, expense_date, description, amount, billtype, payment_type, created_at)  
                VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $exp->bind_param("sssdss", $bill_no, $paid_date, $desc, $paid, $billtype, $payment_type);
            if (!$exp->execute()) {
                throw new Exception("Error inserting school_expenses: " . $exp->error);
            }
    
            // ✅ If all succeed — COMMIT
            $conn->commit();
            echo "success|" . $bill_no;
    
        } catch (Exception $e) {
            // ❌ On any failure — ROLLBACK
            $conn->rollback();
            echo "error: " . $e->getMessage();
        }
    
        exit;
    }


    // 4. Fetch payment history (with pagination + filter)
    if ($_POST['action'] == "get_history" && !empty($_POST['adid'])) {
        $adid = $_POST['adid'];
        $limit = 5;
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $offset = ($page - 1) * $limit;
        $fee_type = isset($_POST['fee_type']) ? trim($_POST['fee_type']) : "";

        // Count total
        if ($fee_type != "") {
            $count_stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM student_fees WHERE admission_id = ? AND fee_type = ?");
            $count_stmt->bind_param("ss", $adid, $fee_type);
        } else {
            $count_stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM student_fees WHERE admission_id = ?");
            $count_stmt->bind_param("s", $adid);
        }
        $count_stmt->execute();
        $total = $count_stmt->get_result()->fetch_assoc()['cnt'];
        $pages = ($total > 0) ? ceil($total / $limit) : 1;
        $count_stmt->close();

        // Fetch records
        if ($fee_type != "") {
            $stmt = $conn->prepare("SELECT bill_no, fee_type, pending_amount, paid_amount, paid_date 
                                    FROM student_fees 
                                    WHERE admission_id = ? AND fee_type = ? 
                                    ORDER BY created_date DESC 
                                    LIMIT ?, ?");
            $stmt->bind_param("ssii", $adid, $fee_type, $offset, $limit);
        } else {
            $stmt = $conn->prepare("SELECT bill_no, fee_type, pending_amount, paid_amount, paid_date 
                                    FROM student_fees 
                                    WHERE admission_id = ? 
                                    ORDER BY created_date DESC 
                                    LIMIT ?, ?");
            $stmt->bind_param("sii", $adid, $offset, $limit);
        }
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Bill No</th>
                        <th>Fee Type</th>
                        <th>Pending Before</th>
                        <th>Paid Amount</th>
                        <th>Paid Date</th>
                    </tr>";
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['bill_no']}</td>
                        <td>" . ucfirst($row['fee_type']) . "</td>
                        <td>{$row['pending_amount']}</td>
                        <td>{$row['paid_amount']}</td>
                        <td>{$row['paid_date']}</td>
                      </tr>";
            }
            echo "</table>";

            // Pagination links
            echo "<div style='text-align:center;margin-top:8px;'>";
            for ($i = 1; $i <= $pages; $i++) {
                $active = ($i == $page) ? "style='font-weight:bold;color:#2f80d0;'" : "";
                echo "<a href='#' class='page-link' data-page='{$i}' {$active}>{$i}</a> ";
            }
            echo "</div>";
        } else {
            echo "<p style='text-align:center;color:#999;'>No payment history found.</p>";
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Fee Details</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        .blue-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 20px auto;
            width: 90%;
            background: white;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .blue-box-header {
            background-color: #2f80d0;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .blue-box-body {
            padding: 20px;
            background: #fff;
        }

        .btn-home,
        .btn-logout {
            border: 1px solid red;
            background: white;
            color: red;
            font-size: 14px;
            padding: 2px 10px;
            text-decoration: none;
            margin-left: 5px;
        }

        .btn-home:hover,
        .btn-logout:hover {
            background: red;
            color: white;
        }

        select {
            padding: 5px;
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background: #f2f2f2;
        }

        .student-photo {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-pay, .btn-history {
            background: #2f80d0;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-pay:hover, .btn-history:hover{
            background: #1b5ba3;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background: #fff;
            width: 400px;
            max-width: 95%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .popup-box h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #2f80d0;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-row label {
            width: 40%;
            font-size: 14px;
        }

        .form-row input,
        .form-row select {
            width: 55%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .popup-buttons {
            text-align: right;
            margin-top: 15px;
        }

        .btn-submit {
            background: #28a745;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .btn-close {
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 8px;
        }

        .success-msg {
            margin-top: 10px;
            color: green;
            font-weight: bold;
            display: none;
            text-align: center;
        }

        .btn-print {
            background: #007bff;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 8px;
            display: none;
        }

        #totalDue {
            font-weight: bold;
            color: #d9534f;
        }

        /* History popup adjustments */
        .popup-box.history {
            width: 700px;
            max-height: 85vh;
            overflow: auto;
        }

        .history-filter-row {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-filter-row select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container">
        <div class="blue-box">
            <div class="blue-box-header">
                <span>View Student Details</span>
                <div>
                    <a href="home.php" class="btn-home">Home</a>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
            <div class="blue-box-body">
                <label for="std">Select Standard:</label>
                <select id="std">
                    <option value="">-- Select Standard --</option>
                    <?php
                    $stdq = $conn->query("SELECT DISTINCT standard FROM sclfeedetails ORDER BY ID ASC");
                    while ($row = $stdq->fetch_assoc()) {
                        echo "<option value='{$row['standard']}'>{$row['standard']}</option>";
                    }
                    ?>
                </select>

                <label for="student">Select Student:</label>
                <select id="student">
                    <option value="">-- Select Student --</option>
                </select>

                <div id="student-details"></div>
            </div>
        </div>
    </div>

    <!-- Popup: Pay Fee -->
    <div class="popup-overlay" id="popup">
        <div class="popup-box">
            <h3>Pay Fee</h3>
            <form id="feeForm">
                <input type="hidden" id="adid" name="adid">
                <div class="form-row"><label>Student Name</label><input type="text" id="stuName" readonly></div>
                <div class="form-row"><label>Standard</label><input type="text" id="stuStd" readonly></div>
                <div class="form-row">
                    <label>Fee Type</label>
                    <select id="feeType">
                        <option value="">-- Select Fee Type --</option>
                        <option value="study">School Fee</option>
                        <option value="van">Van Fee</option>
                    </select>
                </div>
                <div class="form-row"><label>Current Pending</label><input type="text" id="pendingAmount" readonly></div>
                <div class="form-row"><label>Last Year Pending</label><input type="text" id="lastYearPending" readonly></div>
                <div class="form-row"><label>Total Due</label><input type="text" id="totalDue" readonly></div>
                <div class="form-row">
                    <label>Payment Type</label>
                    <select id="payment_type">
                        <option value="">-- Select Payment Type --</option>
                        <option value="Cash">Cash</option>
                        <option value="GPay">GPay</option>
                    </select>
                </div>
                <div class="form-row"><label>Pay Amount</label><input type="number" id="payAmount" min="0"></div>
                <div class="form-row"><label>Remaining Pending</label><input type="text" id="remainAmount" readonly>
                </div>
                <div class="form-row"><label>Paid Date</label><input type="date" id="paidDate"></div>

                <div class="success-msg" id="successMsg">Fee payment saved successfully!</div>

                <div class="popup-buttons">
                    <button type="submit" class="btn-submit" id="btnSubmit">Submit</button>
                    <a href="#" target="_blank" id="printBill" class="btn-submit"
                        style="background:#007bff;display:none;margin-left:8px;">Print Bill</a>
                    <button type="button" class="btn-close" id="btnClose">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup: Payment History -->
    <div class="popup-overlay" id="historyPopup">
        <div class="popup-box history">

            <div class="history-filter-row">
                <div>
                    <label>Filter by Fee Type:</label>
                    <select id="historyFilter">
                        <option value="">All</option>
                        <option value="study">School Fee</option>
                        <option value="van">Van Fee</option>
                    </select>
                </div>
                <div id="historyPagination"></div>
            </div>

            <div id="historyContent" style="max-height:400px;overflow-y:auto;"></div>

            <div class="popup-buttons" style="text-align:right;margin-top:10px;">
                <button class="btn-close" id="closeHistory">Close</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // ✅ Set max date for Paid Date
            const today = new Date().toISOString().split("T")[0];
            $("#paidDate").attr("max", today);
            // Variables for history/print
            let currentAdid = "";
            let printWin = null;

            // load students
            $("#std").change(function () {
                let std = $(this).val();
                if (std != "") {
                    $.post("studentfee.php", { action: "get_students", std: std }, function (data) {
                        $("#student").html('<option value="">-- Select Student --</option>' + data);
                        $("#student-details").html("");
                    });
                } else {
                    $("#student").html('<option value="">-- Select Student --</option>');
                    $("#student-details").html("");
                }
            });

            // load details
            $("#student").change(function () {
                let adid = $(this).val();
                if (adid != "") {
                    $.post("studentfee.php", { action: "get_details", adid: adid }, function (data) {
                        $("#student-details").html(data);
                    });
                } else {
                    $("#student-details").html("");
                }
            });

            // open pay popup
            $(document).on("click", ".btn-pay", function () {
                $("#adid").val($(this).data("adid"));
                $("#stuName").val($(this).data("name"));
                $("#stuStd").val($(this).data("std"));
                $("#feeType").val("");
                $("#payment_type").val("");
                $("#pendingAmount").val("");
                $("#payAmount").val("");
                $("#remainAmount").val("");
                $("#paidDate").val("");
                $("#successMsg").hide();
                $("#printBill").hide();
                $("#btnSubmit").prop("disabled", true);
                $("#popup").css("display", "flex").hide().fadeIn();
            });

            // select fee type in pay popup
            $("#feeType").change(function () {
                let type = $(this).val();
                let btn = $(".btn-pay[data-adid='" + $("#adid").val() + "']");
                let currentSchool = parseFloat(btn.data("pending-school")) || 0;
                let currentVan = parseFloat(btn.data("pending-van")) || 0;
                let lastSchool = parseFloat(btn.data("lastyear-school")) || 0;
                let lastVan = parseFloat(btn.data("lastyear-van")) || 0;

                let current = 0, last = 0;

                if (type === "study") {
                    current = currentSchool;
                    last = lastSchool;
                } else if (type === "van") {
                    current = currentVan;
                    last = lastVan;
                }
                let total = current + last;
                $("#pendingAmount").val(current);
                $("#lastYearPending").val(last);
                $("#totalDue").val(total);
                $("#remainAmount").val(total);
                $("#payAmount").val("");
                if (total <= 0) {
                    $("#btnSubmit").prop("disabled", true);
                } else {
                    $("#btnSubmit").prop("disabled", false);
                }
            });

            // calculate remaining
            $("#payAmount").on("input", function () {
                let totalDue = parseFloat($("#totalDue").val()) || 0;
                let pay = parseFloat($(this).val()) || 0;
                $("#remainAmount").val(totalDue - pay);
            });

            // submit fee form
            $("#feeForm").submit(function (e) {
                e.preventDefault();
                let paidDate = $("#paidDate").val();
                if (paidDate > today) {
                    alert("Paid Date cannot be in the future.");
                    return;
                }

                let data = {
                    action: "save_fee",
                    adid: $("#adid").val(),
                    fee_type: $("#feeType").val(),
                    payment_type: $("#payment_type").val(),
                    stu_name: $("#stuName").val(),
                    total_amount: $("#remainAmount").val(),
                    paid_amount: $("#payAmount").val(),
                    paid_date: paidDate
                };
                $.post("studentfee.php", data, function (res) {
                    if (res.includes('success|')) {
                        $("#btnSubmit").prop("disabled", true);
                        let billNo = res.split("|")[1];
                        $("#successMsg").fadeIn();
                        $("#printBill").attr("href", "print_expense.php?bill_no=" + encodeURIComponent(billNo)).show();
                        // refresh student details so pending values update
                        $("#student").trigger("change");
                    } else {
                        alert("Error: " + res);
                    }
                });
            });

            // close pay popup
            $("#btnClose").click(function () { $("#popup").fadeOut(); });

            // ================= Payment History =================
            // open history popup
            $(document).on("click", ".btn-history", function () {
                currentAdid = $(this).data("adid");
                $("#historyFilter").val("");
                loadHistory(currentAdid, 1, "");
            });

            // load history (ajax)
            function loadHistory(adid, page, feeType) {
                $.post("studentfee.php", { action: "get_history", adid: adid, page: page, fee_type: feeType }, function (data) {
                    $("#historyContent").html(data);
                    $("#historyPopup").css("display", "flex").hide().fadeIn();
                    // reset print window so that print opens fresh content (if you want to reuse same window for unchanged content, remove this line)
                    printWin = null;
                });
            }

            // pagination click
            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                let feeType = $("#historyFilter").val();
                loadHistory(currentAdid, page, feeType);
            });

            // filter change
            $("#historyFilter").change(function () {
                let feeType = $(this).val();
                loadHistory(currentAdid, 1, feeType);
            });

            // close history popup
            $("#closeHistory").click(function () {
                $("#historyPopup").fadeOut();
            });

        });
    </script>
</body>

</html>
