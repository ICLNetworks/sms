<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}
include("includes/db.conn.php");

// ---------------- TAB TRACKING ----------------
$activeTab = $_POST['active_tab'] ?? ($_GET['active_tab'] ?? 'expenses');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container">
        <div class="blue-box">
            <div class="blue-box-header">
                <span>Dashboard</span>
                <div><a href="home.php" class="btn-home">Home</a><a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>

            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs mb-3 flex-wrap">
                <li class="nav-item">
                    <a class="nav-link <?= ($activeTab === 'expenses') ? 'active' : '' ?>" href="expense_dashboard.php?active_tab=expenses">School Expenses Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activeTab === 'student') ? 'active' : '' ?>" href="expense_dashboard.php?active_tab=student">Student Fees Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activeTab === 'standard') ? 'active' : '' ?>" href="expense_dashboard.php?active_tab=standard">Standard Based Dashboard</a>
                </li>
            </ul>

            <div class="blue-box-body">
                <?php
                // Include the appropriate dashboard
                if ($activeTab === 'expenses') {
                    include("expenses_dash.php");
                } elseif ($activeTab === 'student') {
                    include("student_dash.php");
                } elseif ($activeTab === 'standard') {
                    include("standard_dash.php");
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("footer.php"); ?>
</body>

</html>