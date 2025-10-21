<?php
// standard_dash.php
// Assumes $conn is already defined in parent file

$standards_query = "SELECT DISTINCT standard FROM stu_basic_info ORDER BY id ASC";
$standards_result = $conn->query($standards_query);

$selected_standard = '';
$students_data = [];
$total_school = 0;
$total_van = 0;

// Pagination setup
$limit = 20; // records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['show_details'])) {
    $selected_standard = $_GET['standard'] ?? '';

    if ($selected_standard != '') {
        // Count total rows for pagination
        $count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM stu_basic_info WHERE standard = ?");
        $count_stmt->bind_param("s", $selected_standard);
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $total_rows = $count_result->fetch_assoc()['total'];
        $count_stmt->close();

        $total_pages = ceil($total_rows / $limit);

        // Fetch student data with pagination
        $query = "SELECT id, admission_id, Student_name, father_name, mother_name, standard, 
                         (pending_school_fee + last_year_pending_scl) as pending_school_fee, (pending_van_fee + last_year_pending_van) as pending_van_fee
                  FROM stu_basic_info
                  WHERE standard = ?
                  ORDER BY id ASC
                  LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $selected_standard, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Count total rows for ALL students
        $count_result = $conn->query("SELECT COUNT(*) as total FROM stu_basic_info");
        $total_rows = $count_result->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $limit);

        // Fetch all students with pagination
        $query = "SELECT id, admission_id, Student_name, father_name, mother_name, standard, 
                         (pending_school_fee + last_year_pending_scl) as pending_school_fee, (pending_van_fee + last_year_pending_van) as pending_van_fee
                  FROM stu_basic_info
                  ORDER BY standard ASC, id ASC
                  LIMIT $limit OFFSET $offset";
        $result = $conn->query($query);
    }

    while ($row = $result->fetch_assoc()) {
        $total_school += $row['pending_school_fee'];
        $total_van += $row['pending_van_fee'];
        $students_data[] = $row;
    }
}
?>

<div>
    <!-- Filter Form -->
    <form method="GET" action="expense_dashboard.php" style="display:flex; flex-wrap:wrap; justify-content:center; margin-bottom:20px;">
        <input type="hidden" name="active_tab" value="standard">
        <label for="standard" style="margin-right:10px; font-weight:bold;">Select Standard:</label>
        <select name="standard" id="standard" style="padding:6px 10px; margin-right:10px; border-radius:5px; border:1px solid #ccc;">
            <option value="">--All Standards--</option>
            <?php while($row = $standards_result->fetch_assoc()): ?>
                <option value="<?= $row['standard'] ?>" <?= ($selected_standard == $row['standard']) ? 'selected' : '' ?>>
                    <?= $row['standard'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="show_details" style="padding:6px 12px; border:none; border-radius:5px; background:#007bff; color:#fff; cursor:pointer; font-size:14px;">Show Details</button>
    </form>

    <?php if(count($students_data) > 0): ?>
    <div style="overflow-x:auto;">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Admission ID</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Standard</th>
                    <th>Pending School Fees</th>
                    <th>Pending Van Fees</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=$offset+1; foreach($students_data as $student): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($student['admission_id']) ?></td>
                    <td><?= htmlspecialchars($student['Student_name']) ?></td>
                    <td><?= htmlspecialchars($student['father_name']) ?></td>
                    <td><?= htmlspecialchars($student['mother_name']) ?></td>
                    <td><?= htmlspecialchars($student['standard']) ?></td>
                    <td style="color:<?= ($student['pending_school_fee']>0)?'red':'green' ?>; font-weight:bold;">
                        <?= number_format($student['pending_school_fee'],2) ?>
                    </td>
                    <td style="color:<?= ($student['pending_van_fee']>0)?'red':'green' ?>; font-weight:bold;">
                        <?= number_format($student['pending_van_fee'],2) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-secondary">
                <tr>
                    <td colspan="6"><b>Total Pending</b></td>
                    <td><b><?= number_format($total_school,2) ?></b></td>
                    <td><b><?= number_format($total_van,2) ?></b></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Pagination Links -->
    <div style="text-align:center; margin-top:15px;">
        <?php if ($page > 1): ?>
            <a href="?active_tab=standard&show_details=1&standard=<?= urlencode($selected_standard) ?>&page=<?= $page-1 ?>" class="btn btn-sm btn-outline-primary">Prev</a>
        <?php endif; ?>

        <span style="margin:0 10px;">Page <?= $page ?> of <?= $total_pages ?></span>

        <?php if ($page < $total_pages): ?>
            <a href="?active_tab=standard&show_details=1&standard=<?= urlencode($selected_standard) ?>&page=<?= $page+1 ?>" class="btn btn-sm btn-outline-primary">Next</a>
        <?php endif; ?>
    </div>

    <?php elseif(isset($selected_standard)): ?>
        <p style="text-align:center; margin-top:20px;">No students found.</p>
    <?php endif; ?>
</div>


