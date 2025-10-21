<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php

 include("includes/db.conn.php");
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
    $where .= " AND sf.paid_date BETWEEN '$fy_start' AND '$fy_end'";
}


// Total distinct students for pagination


// $total_result = $conn->query("SELECT * FROM stu_basic_info");
// $total_row = $total_result->fetch_assoc();
// // $total_records = $total_row['total'];
// // $total_pages = ceil($total_records / $limit);

// // Fetch **latest fee info per student**
// $sql = "
// SELECT sf.admission_id, sb.student_name, sb.standard, sf.fee_type, 
//        SUM(sf.paid_amount) AS total_paid,sf.pending_amount AS current_pending,
//        MAX(sf.paid_date) AS last_paid_date,
//        MAX(sf.id) AS id
// FROM student_fees sf
// JOIN stu_basic_info sb ON sf.admission_id = sb.admission_id
// WHERE $where
// GROUP BY sf.admission_id, sf.fee_type
// ORDER BY sb.student_name, sf.created_date desc
// LIMIT $limit OFFSET $offset
// ";

// $result = $conn->query($sql);


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
        
            <?php 
                
           $res = mysqli_query("select * from stu_basic_info");

                    while($row = mysqli_fetch_array($res))
                    {
                        $admission_id = $row['admission_id'];
            ?>
                <tr>
                    <td> fdf <? echo "$admission_id"; ?></td>
                   
                </tr>
            <?php 
            } ?>
       
            
        </tbody>
    </table>
</div>
