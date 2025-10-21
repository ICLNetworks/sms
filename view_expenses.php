<?php
$today = date('Y-m-d');
$activeTab = 'view';

// ---------------- FILTER ----------------
$where = "1=1";
$from = $_POST['from_date'] ?? '';
$to = $_POST['to_date'] ?? '';
if (!empty($from) && !empty($to)) {
    $where = "expense_date BETWEEN '$from' AND '$to'";
}

// ---------------- PAGINATION ----------------
$limit = 20;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM school_expenses WHERE $where");
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// ---------------- FETCH EXPENSES ----------------
$sql = "SELECT * FROM school_expenses WHERE $where ORDER BY CAST(SUBSTRING(bill_no,8) AS UNSIGNED) DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// ---------------- CALCULATE TOTALS ----------------
$total_credit = 0;
$total_debit = 0;
$res_totals = $conn->query("SELECT * FROM school_expenses WHERE $where");
while($row_tot = $res_totals->fetch_assoc()){
    if($row_tot['billtype']==='Credit') $total_credit += $row_tot['amount'];
    else $total_debit += $row_tot['amount'];
}
$pending_amount = $total_credit - $total_debit;
?>

<div class="tab-pane fade show active" id="view">
    <form method="POST" class="row g-3 mb-3">
        <input type="hidden" name="active_tab" value="view">
        <div class="col-md-3">
            <label>From</label>
            <input type="date" name="from_date" class="form-control" value="<?= $from ?>" max="<?= $today ?>">
        </div>
        <div class="col-md-3">
            <label>To</label>
            <input type="date" name="to_date" class="form-control" value="<?= $to ?>" max="<?= $today ?>">
        </div>
        <div class="col-md-6 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="expenses.php?active_tab=view" class="btn btn-danger">Reset</a>
        </div>
    </form>

    <div class="mb-3">
        <b>Total Credit:</b> <span class="text-success"><?= number_format($total_credit,2) ?></span> |
        <b>Total Debit:</b> <span class="text-danger"><?= number_format($total_debit,2) ?></span> |
        <b>Pending:</b> <span class="<?= ($pending_amount <=0)?'text-danger':'text-success' ?>"><?= number_format($pending_amount,2) ?></span>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Bill No</th>
                <th>Date</th>
                <th>Description</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Payment Type</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if($result->num_rows>0): while($row=$result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['bill_no'] ?></td>
                <td><?= $row['expense_date'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['billtype']==='Credit'?number_format($row['amount'],2):'-' ?></td>
                <td><?= $row['billtype']==='Debit'?number_format($row['amount'],2):'-' ?></td>
                <td><?= $row['payment_type'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <?php if (strpos($row['description'], 'Student Fee') === false): ?>
                        <a href="expenses.php?active_tab=crud&edit_bill=<?= $row['bill_no'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <?php else: ?>
                        <a class="btn btn-sm btn-secondary disabled" tabindex="-1" aria-disabled="true">Edit</a>
                    <?php endif; ?>

                    <a href="print_expense.php?bill_no=<?= $row['bill_no'] ?>" target="_blank" class="btn btn-sm btn-primary">Print</a>
                </td>
            </tr>
        <?php endwhile; else: ?>
            <tr><td colspan="8">No records found</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
        <?php for($i=1;$i<=$total_pages;$i++): ?>
            <li class="page-item <?= ($i==$page)?'active':'' ?>">
                <a class="page-link" href="expenses.php?page=<?= $i ?>&active_tab=view"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        </ul>
    </nav>
</div>

