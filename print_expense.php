<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}
include("includes/db.conn.php");

if (!isset($_GET['bill_no'])) {
    die("No bill number provided.");
}

$bill_no = $_GET['bill_no'];

// Fetch expense by bill number
$stmt = $conn->prepare("SELECT * FROM school_expenses LEFT JOIN student_fees ON school_expenses.bill_no = student_fees.bill_no WHERE school_expenses.bill_no = ?");
$stmt->bind_param("s", $bill_no);
$stmt->execute();
$result = $stmt->get_result();
$expense = $result->fetch_assoc();
$stmt->close();


if (!$expense) {
    die("Expense not found.");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Invoice <?= $expense['bill_no'] ?></title>
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
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 10px;
        }

        h2 {
            font-weight: bold;
        }

        .table th,
        .table td {
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
            /* border: 2px solid red; */
            overflow: hidden;
        }

        .header-banner img {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            margin: 0 0 10px 0;
        }

        
    </style>
</head>

<body>

    <div class="invoice-box">
        <h2 class="text-center">INVOICE</h2>
        <div class="header-banner">
            <img src="assets/img/head2.jpg">
        </div>

        <div class="row mb-4">
            <div class="col">
                <p><b>Date Issued:</b> <?= date("d M Y", strtotime($expense['expense_date'])) ?></p>
                <p><b>Bill No:</b> <?= $bill_no ?></p>
            </div>
            <div class="col text-end">
                <p><b>Paymate Type</b></p>
                <p><?= $expense['billtype'] ?? 'Not Provided' ?></p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?= $expense['description'] ?></td>
                    <td><?= $expense['qty'] ?? 1 ?></td>
                    <td>Rs.<?= number_format($expense['amount'], 2) ?></td>
                    <td>Rs.<?= number_format(($expense['qty'] ?? 1) * $expense['amount'], 2) ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end grand-total">Grand Total</td>
                    <td class="grand-total">Rs.<?= number_format(($expense['qty'] ?? 1) * $expense['amount'], 2) ?></td>
                </tr>
                <?php if (!is_null($expense['pending_amount']) && $expense['pending_amount'] > 0): ?>
                <TR>
                    <td colspan="5" valign="left"><b>Total Fees Pending:</b> Rs.<?= number_format($expense['pending_amount'], 2) ?></td>
                </TR>
                <?php endif; ?>
            </tfoot>
        </table>

        <p><b>Note:</b><br>
            Bank Name: SMS<br>
            Account No: XXXXXXXXXXXXXXXX</p>

        <div class="signature">
            <p>__________________________</p>
            <p><b>Secretary / Principal / In-Charge</b></p>
        </div>
        <div class="text-center mt-4 no-print">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>

        <!-- <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div> -->
    </div>
</body>

</html>