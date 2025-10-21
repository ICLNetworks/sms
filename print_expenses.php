<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}
include("includes/db.conn.php");

// ---------------- FILTER VALUES ----------------
$today = date('Y-m-d');
$from = $_POST['from_date'] ?? '';
$to = $_POST['to_date'] ?? '';
$bill_type_filter = $_POST['bill_type'] ?? '';
$payment_type_filter = $_POST['payment_type'] ?? '';

$where = "1=1";

// Date filter
if (!empty($from) && !empty($to)) {
    $where .= " AND expense_date BETWEEN '$from' AND '$to'";
}

// Bill Type filter
if (!empty($bill_type_filter)) {
    if ($bill_type_filter === 'ToSabai') {
        $where .= " AND description='Amount given to Sabai'";
    } else {
        $where .= " AND billtype='$bill_type_filter'";
    }
}

// Payment Type filter
if (!empty($payment_type_filter)) {
    $where .= " AND payment_type='$payment_type_filter'";
}

// ---------------- FETCH FILTERED EXPENSES ----------------
$sql = "SELECT * FROM school_expenses WHERE $where ORDER BY CAST(SUBSTRING(bill_no,8) AS UNSIGNED) DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Filtered Expenses Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
        body {
            padding: 40px;
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 10px;
        }
        h2 {
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .grand-total {
            font-weight: bold;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .header-banner {
            width: 100%;
            overflow: hidden;
        }
        .header-banner img {
            width: 100%;
            height: auto;
            border-radius: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <h2 class="text-center">EXPENSE REPORT</h2>
    <div class="header-banner">
        <img src="assets/img/head2.jpg">
    </div>

    <div class="row mb-4">
        <div class="col">
            <p><b>Date Issued:</b> <?= date("d M Y") ?></p>
            <p><b>Filter Period:</b> 
                <?= !empty($from) && !empty($to) ? date("d M Y", strtotime($from)) . " - " . date("d M Y", strtotime($to)) : "All Dates" ?>
            </p>
        </div>
        <div class="col text-end">
            <p><b>Bill Type:</b> <?= $bill_type_filter ?: "All" ?></p>
            <p><b>Payment Type:</b> <?= $payment_type_filter ?: "All" ?></p>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Bill No</th>
                <th>Date</th>
                <th>Description</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Payment Type</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1; 
            $total_credit = 0;
            $total_debit = 0;
            if ($result->num_rows > 0): 
                while($row = $result->fetch_assoc()): 
                    if ($row['billtype']=='Credit') $total_credit += $row['amount'];
                    if ($row['billtype']=='Debit') $total_debit += $row['amount'];
            ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $row['bill_no'] ?></td>
                    <td><?= date("d M Y", strtotime($row['expense_date'])) ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['billtype']=='Credit' ? "Rs.".number_format($row['amount'],2) : "-" ?></td>
                    <td><?= $row['billtype']=='Debit' ? "Rs.".number_format($row['amount'],2) : "-" ?></td>
                    <td><?= $row['payment_type'] ?></td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7">No records found</td></tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end grand-total">Total Credit</td>
                <td class="grand-total">Rs.<?= number_format($total_credit,2) ?></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end grand-total">Total Debit</td>
                <td></td>
                <td class="grand-total">Rs.<?= number_format($total_debit,2) ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="text-end grand-total">Pending Amount</td>
                <td colspan="3" class="grand-total">
                    Rs.<?= number_format($total_credit - $total_debit,2) ?>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="signature">
        <p>__________________________</p>
        <p><b>Secretary / Principal / In-Charge</b></p>
    </div>

    <div class="text-center mt-4 no-print">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
</div>
</body>
</html>
