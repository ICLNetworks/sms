<?php
// Filters
$selected_standard = $_POST['standard'] ?? '';
$study_year = $_POST['study_year'] ?? '';

// Pagination
$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Build WHERE condition
$where = "1=1";
if (!empty($selected_standard)) {
    $where .= " AND sb.standard = '$selected_standard'";
}
if (!empty($study_year)) {
    list($start_year, $end_year) = explode('-', $study_year);
    $fy_start = $start_year . "-04-01";
    $fy_end = $end_year . "-03-31";
    $where .= " AND sf1.paid_date BETWEEN '$fy_start' AND '$fy_end'";
}

// Total distinct students for pagination
$total_result = $conn->query("SELECT COUNT(DISTINCT sb.admission_id) AS total 
                              FROM student_fees sf
                              JOIN stu_basic_info sb ON sf.admission_id = sb.admission_id
                              WHERE $where");
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);
$sql = "SELECT sf1.admission_id, sf1.fee_type, sb.student_name, sb.standard,
            SUM(sf1.paid_amount) AS total_paid,
            MAX(sf1.paid_date) AS last_paid_date,
            (SELECT pending_amount FROM student_fees sf2
                WHERE sf2.admission_id = sf1.admission_id
                AND sf2.fee_type = sf1.fee_type
                ORDER BY  id DESC
                LIMIT 1) AS current_pending
            FROM student_fees sf1
            JOIN stu_basic_info sb ON sf1.admission_id = sb.admission_id
            WHERE $where
            GROUP BY sf1.admission_id, sf1.fee_type
            LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
?>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Admission ID</th>
                <th>Student Name</th>
                <th>Standard</th>
                <th>Fee Type</th>
                <th>Total Paid Amount</th>
                <th>Current Pending Amount</th>
                <th>Last Paid Date</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['admission_id']) ?></td>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= htmlspecialchars($row['standard']) ?></td>
                    <td><?= htmlspecialchars($row['fee_type']) ?></td>
                    <td class="text-success"><?= number_format($row['total_paid'],2) ?></td>
                    <td class="text-danger"><?= number_format($row['current_pending'],2) ?></td>
                    <td><?= htmlspecialchars($row['last_paid_date']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No student fee records found</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>