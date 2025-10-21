<?php
// ---------------- EXPENSES SECTION ----------------
$today = date('Y-m-d');
$from = $_POST['from_date'] ?? '';
$to = $_POST['to_date'] ?? '';
$bill_type_filter = $_POST['bill_type'] ?? '';
$payment_type_filter = $_POST['payment_type'] ?? '';
$study_year = $_POST['study_year'] ?? '';

// Build query
$where = "1=1";

// Date range filter
if (!empty($from) && !empty($to)) {
    $where .= " AND expense_date BETWEEN '$from' AND '$to'";
}

// Study year filter
if (!empty($study_year)) {
    list($start_year, $end_year) = explode('-', $study_year);
    $fy_start = $start_year . "-04-01";
    $fy_end = $end_year . "-03-31";
    $where .= " AND expense_date BETWEEN '$fy_start' AND '$fy_end'";
}

// Bill Type filter
if (!empty($bill_type_filter)) {
    if ($bill_type_filter == 'ToSabai') {
        $where .= " AND description='Amount given to Sabai'";
    } else {
        $where .= " AND billtype='$bill_type_filter'";
    }
}

// Payment Type filter
if (!empty($payment_type_filter) && $bill_type_filter != 'ToSabai') {
    $where .= " AND payment_type='$payment_type_filter'";
}

// Export CSV
if (isset($_POST['export_csv'])) {
    $sql_export = "SELECT * FROM school_expenses WHERE $where ORDER BY CAST(SUBSTRING(bill_no,8) AS UNSIGNED) DESC";
    $res_export = $conn->query($sql_export);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="expenses_export.csv"');
    $out = fopen("php://output", "w");
    fputcsv($out, ['bill_no','expense_date','description','amount','billtype','payment_type','created_at']);
    while ($row = $res_export->fetch_assoc()) {
        fputcsv($out, [
            $row['bill_no'],
            $row['expense_date'],
            $row['description'],
            $row['amount'],
            $row['billtype'],
            $row['payment_type'],
            $row['created_at']
        ]);
    }
    fclose($out);
    exit;
}

// Pagination
$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM school_expenses WHERE $where");
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql = "SELECT * FROM school_expenses WHERE $where ORDER BY CAST(SUBSTRING(bill_no,8) AS UNSIGNED) DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// ---------------- CALCULATE TOTALS ----------------
$total_credit = 0;
$total_debit = 0;
$sql_totals = "SELECT * FROM school_expenses WHERE $where";
$res_totals = $conn->query($sql_totals);
while ($row_tot = $res_totals->fetch_assoc()) {
    if ($row_tot['billtype'] === 'Credit') $total_credit += $row_tot['amount'];
    else $total_debit += $row_tot['amount'];
}
$pending_balance = $total_credit - $total_debit;
?>

<!-- Totals Display -->
<div class="row mb-3">
    <div class="col-12 col-md-4">
        <div class="p-2 border rounded bg-light text-success text-center">
            <strong>Total Credit:</strong> Rs.<?= number_format($total_credit, 2) ?>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="p-2 border rounded bg-light text-danger text-center">
            <strong>Total Debit:</strong> Rs.<?= number_format($total_debit, 2) ?>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="p-2 border rounded bg-light text-warning text-center">
            <strong>Pending Balance:</strong> Rs.<?= number_format($pending_balance, 2) ?>
        </div>
    </div>
</div>

<!-- Expenses Filter & Table -->
<form method="POST" class="mb-3">
    <input type="hidden" name="active_tab" value="expenses">

    <!-- 1️⃣ Filter Inputs -->
    <div class="row g-3 mb-2">
        <div class="col-12 col-sm-6 col-md-2">
            <label class="form-label">From</label>
            <input type="date" name="from_date" class="form-control" value="<?= htmlspecialchars($from) ?>" max="<?= $today ?>">
        </div>

        <div class="col-12 col-sm-6 col-md-2">
            <label class="form-label">To</label>
            <input type="date" name="to_date" class="form-control" value="<?= htmlspecialchars($to) ?>" max="<?= $today ?>">
        </div>

        <div class="col-12 col-sm-6 col-md-2">
            <label class="form-label">Study Year</label>
            <select name="study_year" class="form-select">
                <option value="">-- Select Study Year --</option>
                <?php
                $startYear = 2020;
                $currentYear = date("Y");
                $endYear = $currentYear + 1;

                for ($y = $startYear; $y < $endYear; $y++) {
                    $next = $y + 1;
                    $val = "$y-$next";
                    $selected = ($study_year == $val) ? "selected" : "";
                    echo "<option value='$val' $selected>$val</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-2">
            <label class="form-label">Bill Type</label>
            <select name="bill_type" id="billTypeSelect" class="form-select">
                <option value="">All</option>
                <option value="Credit" <?= ($bill_type_filter=='Credit')?'selected':'' ?>>Credit</option>
                <option value="Debit" <?= ($bill_type_filter=='Debit')?'selected':'' ?>>Debit</option>
                <option value="ToSabai" <?= ($bill_type_filter=='ToSabai')?'selected':'' ?>>ToSabai</option>
            </select>
        </div>

        <div class="col-12 col-sm-6 col-md-2" id="paymentTypeDiv">
            <label class="form-label">Payment Type</label>
            <select name="payment_type" class="form-select">
                <option value="">All</option>
                <option value="Cash" <?= ($payment_type_filter=='Cash')?'selected':'' ?>>Cash</option>
                <option value="GPay" <?= ($payment_type_filter=='GPay')?'selected':'' ?>>GPay</option>
            </select>
        </div>
    </div>

    <!-- 2️⃣ Buttons -->
    <div class="row g-2">
        <div class="col-12 d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <button type="submit" name="export_csv" class="btn btn-success">Export CSV</button>
            <button type="button" class="btn btn-info" onclick="window.print()">Print</button>
            <a href="expense_dashboard.php?active_tab=expenses" class="btn btn-danger">Reset</a>
        </div>
    </div>
</form>


<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Bill No</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Bill Type</th>
                <th>Payment Type</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Bill No"><?= htmlspecialchars($row['bill_no']) ?></td>
                    <td data-label="Date"><?= htmlspecialchars($row['expense_date']) ?></td>
                    <td data-label="Description"><?= htmlspecialchars($row['description']) ?></td>
                    <td data-label="Amount"><?= number_format($row['amount'],2) ?></td>
                    <td data-label="Bill Type"><?= htmlspecialchars($row['billtype']) ?></td>
                    <td data-label="Payment Type"><?= htmlspecialchars($row['payment_type']) ?></td>
                    <td data-label="Created At"><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No expense records found</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center flex-wrap">
        <?php for($i=1;$i<=$total_pages;$i++): ?>
            <li class="page-item <?= ($i==$page)?'active':'' ?>">
                <a class="page-link" href="expense_dashboard.php?page=<?= $i ?>&active_tab=expenses"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const billTypeSelect = document.getElementById('billTypeSelect');
    const paymentTypeDiv = document.getElementById('paymentTypeDiv');

    function togglePaymentType() {
        paymentTypeDiv.style.display = (billTypeSelect.value === 'ToSabai') ? 'none' : 'block';
    }

    togglePaymentType(); // Run on page load
    billTypeSelect.addEventListener('change', togglePaymentType);
});
</script>

<style>
@media (max-width: 768px) {
    .table thead { display: none; }
    .table tbody td { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem; }
    .table tbody td::before { content: attr(data-label); font-weight: bold; flex-basis: 50%; }
}
</style>
