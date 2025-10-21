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
    <?php
        session_start();
        if (isset($_SESSION['error_msg'])):
            $msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        ?>
        <div id="popup-msg" style=" position: fixed; top: 35vh; left: 50%; transform: translate(-50%, -50%) scale(0); 
                color: rgb(125 1 1); font-size: 22px; font-weight: bold; z-index: 9999; opacity: 0; transition: all 0.5s ease; text-align: center;">
            <?php echo $msg; ?>
        </div>
        <script>
            const popup = document.getElementById('popup-msg');
            // Animate in
            setTimeout(() => {
                popup.style.opacity = 1;
                popup.style.transform = "translate(-50%, -50%) scale(1)";
            }, 100);
    
            // Animate out after 5 seconds
            setTimeout(() => {
                popup.style.opacity = 0;
                popup.style.transform = "translate(-50%, -50%) scale(0.8)";
                setTimeout(() => { popup.remove(); }, 500);
            }, 5100);
        </script>
    <?php endif; ?>


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
                    <a class="nav-link <?= ($activeTab === 'crud') ? 'active' : '' ?>" href="expenses.php?active_tab=crud">Add / Edit Expense</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activeTab === 'view') ? 'active' : '' ?>" href="expenses.php?active_tab=view">View Expenses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activeTab === 'imrex') ? 'active' : '' ?>" href="expenses.php?active_tab=imrex">Import / Export</a>
                </li>
            </ul>

            <div class="blue-box-body">
                <?php
                // Include the appropriate dashboard
                if ($activeTab === 'crud') {
                    include("cu_expenses.php");
                } elseif ($activeTab === 'view') {
                    include("view_expenses.php");
                } elseif ($activeTab === 'imrex') {
                    include("im_ex_expenses.php");
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>