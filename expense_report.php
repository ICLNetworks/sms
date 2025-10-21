<?php
include("includes/db.conn.php");

// Initialize variables
$filter_type = $_POST['filter_type'] ?? 'monthly';
$start_date = $_POST['start_date'] ?? null;
$end_date = $_POST['end_date'] ?? null;

$where = "1=1";

if ($filter_type == 'monthly') {
    $where .= " AND MONTH(expense_date) = MONTH(CURRENT_DATE()) AND YEAR(expense_date) = YEAR(CURRENT_DATE())";
} elseif ($filter_type == 'yearly') {
    $where .= " AND YEAR(expense_date) = YEAR(CURRENT_DATE())";
} elseif ($filter_type == 'custom' && $start_date && $end_date) {
    $where .= " AND expense_date BETWEEN '$start_date' AND '$end_date'";
}

// Fetch expenses
$sql = "SELECT * FROM school_expenses WHERE $where ORDER BY expense_date ASC";
$result = $conn->query($sql);

// Initialize totals
$total_credit = 0;
$total_debit = 0;
$expenses = [];

while ($row = $result->fetch_assoc()) {
    $expenses[] = $row;
    if ($row['billtype'] == 'Credit') {
        $total_credit += $row['amount'];
    } else {
        $total_debit += $row['amount'];
    }
}

$balance = $total_credit - $total_debit;
?>

<!DOCTYPE html>
<html>
<head>
    <title>School Expenses Report</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        tfoot td { font-weight: bold; }
    </style>
</head>
<body>
    <h2>School Expenses Report</h2>
    <form method="POST">
        <label>Filter:</label>
        <select name="filter_type" id="filter_type" onchange="toggleDateInputs()">
            <option value="monthly" <?= $filter_type=='monthly'?'selected':'' ?>>Monthly</option>
            <option value="yearly" <?= $filter_type=='yearly'?'selected':'' ?>>Yearly</option>
            <option value="custom" <?= $filter_type=='custom'?'selected':'' ?>>Custom Range</option>
        </select>
        <input type="date" name="start_date" id="start_date" value="<?= $start_date ?>" <?= $filter_type=='custom'?'':'style="display:none"' ?>>
        <input type="date" name="end_date" id="end_date" value="<?= $end_date ?>" <?= $filter_type=='custom'?'':'style="display:none"' ?>>
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Bill No</th>
                <th>Expense Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Bill Type</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($expenses)): ?>
                <?php foreach($expenses as $exp): ?>
                    <tr>
                        <td><?= $exp['bill_no'] ?></td>
                        <td><?= $exp['expense_date'] ?></td>
                        <td><?= $exp['description'] ?></td>
                        <td><?= number_format($exp['amount'],2) ?></td>
                        <td><?= $exp['billtype'] ?></td>
                        <td><?= $exp['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Credit</td>
                <td colspan="3"><?= number_format($total_credit,2) ?></td>
            </tr>
            <tr>
                <td colspan="3">Total Debit</td>
                <td colspan="3"><?= number_format($total_debit,2) ?></td>
            </tr>
            <tr>
                <td colspan="3">Balance</td>
                <td colspan="3"><?= number_format($balance,2) ?></td>
            </tr>
        </tfoot>
    </table>

    <script>
        function toggleDateInputs() {
            var filter = document.getElementById('filter_type').value;
            if(filter === 'custom') {
                document.getElementById('start_date').style.display = 'inline';
                document.getElementById('end_date').style.display = 'inline';
            } else {
                document.getElementById('start_date').style.display = 'none';
                document.getElementById('end_date').style.display = 'none';
            }
        }
    </script>
</body>
</html>
