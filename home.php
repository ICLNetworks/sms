<?php
@ob_start();
@session_start();
?>
<?php
if (isset($_SESSION['login_user'])) {
	include("includes/db.conn.php");
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>Sourashtra Matriculation School</title>
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<!-- GLOBAL STYLES -->
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<!-- FONT AWESOME CDN FIXED -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/countdown.css" />
		<link rel="stylesheet" href="style/style.css" />

		<!-- CUSTOM STYLES -->
		<style>
			body {
				background-color: #f5f5f5;
			}
			.inner {
				text-align: center;
				padding: 25px 15px;
				border-radius: 5px;
				background: #e6f0fa;
				margin-bottom: 20px;
				transition: transform 0.2s, background 0.2s;
				min-height: 150px;
				display: flex;
				flex-direction: column;
				justify-content: center;
			}

			.inner:hover {
				transform: scale(1.05);
				background: #d4e3f8;
			}

			.inner i {
				margin-bottom: 15px;
				color: #0b2341;
			}

			.inner a {
				text-decoration: none;
				color: #0b2341;
				font-weight: bold;
				font-size: 16px;
			}

			.inner a:hover {
				text-decoration: none;
				color: #2f80d0;
			}
		</style>
	</head>

	<body>
		<div class="container">
			<!-- HEADER BANNER -->
			<?php include("header.php"); ?>

			<!-- BLUE BOX DASHBOARD -->
			<div class="blue-box">
				<div class="blue-box-header">
					Dashboard
				</div>
				<div class="blue-box-body">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-user-plus fa-4x"></i>
								<a href="admission.php">Admission Register</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-users fa-4x"></i>
								<a href="adminview.php">Admission View</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-money fa-4x"></i>
								<a href="fee_manage.php">Add/Update Fees Details</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-bar-chart fa-4x"></i>
								<a href="expense_dashboard.php">Expenses Dashboard</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-list fa-4x"></i>
								<a href="expenses.php?active_tab=crud">Expenses Details</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-graduation-cap fa-4x"></i>
								<a href="studentfee.php">Student Fees</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-key fa-4x"></i>
								<a href="change.php">Change Password</a>
							</div>
						</div>

						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="inner">
								<i class="fa fa-sign-out fa-4x"></i>
								<a href="logout.php">Logout</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END BLUE BOX -->
		</div>

		<!-- SCRIPTS -->
		<script src="assets/plugins/jquery-2.0.3.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/plugins/countdown/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/countdown.js"></script>
		<?php include("footer.php"); ?>
	</body>

	</html>
	<?php
} else {
	header("Location:index.php");
}
?>