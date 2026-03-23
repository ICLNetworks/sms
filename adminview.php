<?php session_start();
if(isset($_SESSION['login_user']))
{
include("includes/db.conn.php");
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Sourshtra Matriculation School</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />

    <!--END GLOBAL STYLES -->

     <!-- PAGE LEVEL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    
 <link href="assets/css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/plugins/uniform/themes/default/css/uniform.default.css" />
<link rel="stylesheet" href="assets/plugins/inputlimiter/jquery.inputlimiter.1.0.css" />
<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css" />
<link rel="stylesheet" href="assets/plugins/colorpicker/css/colorpicker.css" />
<link rel="stylesheet" href="assets/plugins/tagsinput/jquery.tagsinput.css" />
<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css" />
<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="assets/plugins/timepicker/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
<link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />   
<link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- END PAGE LEVEL  STYLES -->

	 <link rel="stylesheet" href="assets/css/countdown.css" />
     <!-- END PAGE LEVEL STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
</head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
<body >
      <!--MAIN CONTAINER --> 
    
            <?php include("header.php"); ?>
    
	<div id="main"> 
	
        <!-- PAGE CONTENT --> 
      <div class="container">
       
        <div class="clearfix">
         
        </div>
        <div id="counter"></div>
		
<div class="row">
                <div class="col-lg-12">
					<center><h3><b>ADMISSION REGISTERATION DETAILS</b> </h3></center>
				
                 
				 
				 <div class="panel panel-primary">
                        <div class="panel-heading">
                            Admission Details
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>							

							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </div>
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Admission Number</th>
                                            <th>EMIS No</th>
											<th>Date of Admission</th>
											<th>Admission Standard</th>
                                            <th>Name</th>
                                            <th>Date of Birth</th>
											<th>Community/Sub Caste</th>
											<th>Photo</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										                                      
									   <?php
											$result = mysqli_query($conn,"SELECT * FROM register");
												
												$sno=1;
												while($row = mysqli_fetch_array($result)) 
											  {
											  $id=$row['id'];
											  echo "<tr class='odd'> ";
                                              echo "<td>".$sno."</td>";
											  echo "<td>".$row['adno']."</td>";
                                              echo "<td>".$row['emisno']."</td>";
											  echo "<td>".$row['doa']."</td>";
											  echo "<td>".$row['std']."</td>";
											  echo "<td>".$row['name']."</td>";
											  echo "<td>".$row['dob']."</td>";
											  echo "<td>".$row['comm']."/".$row['subc']."</td>";
											  echo "<td class='fileupload-new thumbnail' style='height:75px!important; width:75px!important;' ><img src='".$row['photo']."'></td>";
					  echo "<td class='text-center'><div class='btn-group'>";
					  echo "<a class='btn btn-outline-primary btn-sm' href='admission.php?id=".$id."' title='Edit'><i class='fa-solid fa-pen fa-lg'></i></a>";
					  echo "<a class='btn btn-outline-info btn-sm' href='admission.php?view=".$id."' title='View'><i class='fa-solid fa-eye fa-lg'></i></a>";
					  echo "</div></td>";
							 $sno++;
							 }
							  ?>
						  
						  
					    </tbody>
					</table>
				</div>
			   
                        </div>
			    </div>
			</div>
			</div>
			
			
			   
      </div>
          <!--END PAGE CONTENT --> 
    </div>
     <!--END MAIN CONTAINER --> 
	      

     <!-- GLOBAL SCRIPTS -->
    
	    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <!-- END GLOBAL SCRIPTS -->

	       <!-- PAGE LEVEL SCRIPTS --> 
      <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>
          <script type="text/javascript" src="assets/plugins/countdown/jquery.countdown.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
          
    <script type="text/javascript" src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    
    <script type="text/javascript" src="assets/js/countdown.js"></script>
	<script src="assets/plugins/jasny/js/bootstrap-fileupload.js"></script>
	<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS --> 
<!-- PAGE LEVEL SCRIPT-->
 <script src="assets/js/jquery-ui.min.js"></script>
 <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="assets/plugins/inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="assets/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="assets/plugins/validVal/js/jquery.validVal.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/switch/static/js/bootstrap-switch.min.js"></script>
<script src="assets/plugins/jquery.dualListbox-1.3/jquery.dualListBox-1.3.min.js"></script>
<script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
<script src="assets/plugins/jasny/js/bootstrap-inputmask.js"></script>
       <script src="assets/js/formsInit.js"></script>
        <script>
            $(function () { formInit(); });
        </script>

</body>
    <!-- END BODY -->
</html>
<?php 
}
else {
header("Location:index.php");
}
?>