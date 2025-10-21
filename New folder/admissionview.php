<?php
@ob_start();
session_start();
?>
<?php
if(isset($_SESSION['login_user']))
{
include("includes/db.conn.php");
$id=$_GET['id'];
$result = mysql_query("SELECT * FROM register where id='$id'");
	while($row = mysql_fetch_array($result)) 
  {
$course=$row['course'];
$shift=$row['shift'];
$doa=$row['doa'];
$name=$row['name'];
$sex=$row['sex'];
$dob=$row['dob'];
$comm=$row['comm'];
$subc=$row['subc'];
$pschool=$row['pschool'];
$national=$row['national'];
$religion=$row['religion'];
$fm=$row['fm'];
$tho=$row['tho'];
$income=$row['income'];
$handi=$row['handi'];
$exser=$row['exser'];
$orgin=$row['orgin'];
$sports=$row['sports'];
$addr=$row['addr'];
$tags=$row['tags'];
$photo=$row['photo'];
$dist=$row['dist'];
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
		

        <div id="counter-default" class="row">
		<form  id="block-validate" enctype="multipart/form-data" name="form1" method="post">
		<div class="row">
		
                <div class="col-lg-12">
				<center><h3><b>ADMISSION REGISTERATION FORM</b> </h3></center>
				<center><h5><b>Application form for admission to B.Sc.,/B.A.,/B.Com., courses under Choice Based Credit System(CBCS)</b> </h5></center>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <B>Basic Details<B>
							
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="admission.php">Register</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;							
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="view.php">View</a>
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="index1.php">Home</a>
							
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <td><label class="control-label">COURSE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <label class="control-label"><?php echo $course;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">SHIFT PREFERENCE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <label class="control-label"><?php echo $shift;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">DATE OF ADMISSION</label></td>
                                            <td>
											<div class="form-group">
											<div class="col-lg-6">
											<label class="control-label"><?php echo $doa;?></label>
											</div>
											</div>
										</td>
                                            
                                        </tr>
										                                   
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
					
					
					<div class="panel panel-primary">
                        <div class="panel-heading">
                            <B>Personal Details<B>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <td><label class="control-label">1. NAME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label"><?php echo $name;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">2.SEX</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                
                                                <label class="control-label"><?php echo $sex;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">	3. DATE OF BIRTH</label></td>
                                            <td>
											<div class="form-group">
											<div class="col-lg-6">
											<label class="control-label"><?php echo $dob;?></label>
											</div>
											</div>
											</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>        
										
										<tr>
                                            <td><label class="control-label">4. COMMUNITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <label class="control-label"><?php echo $comm;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">5.SUB CASTE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                <label class="control-label"><?php echo $subc;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
							            <tr>
                                            <td><label class="control-label">6. PREVIOUS SCHOOL NAME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
													<label class="control-label"><?php echo $pschool;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">7. NATIONALITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <label class="control-label"><?php echo $national;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
							
										<tr>
                                            <td><label class="control-label">8. RELIGION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <label class="control-label"><?php echo $religion;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	9. DISTRICT</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <label class="control-label"><?php echo $dist;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">	10. NAME OF FATHER/MOTHER/GUARDIAN</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <label class="control-label"><?php echo $fm;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	11. whether your Father/Mother/Guardian is <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Farmar/Agriculture Labourer/Registered Tanent?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
											<label class="control-label"><?php echo $tho;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	12. ANNUAL INCOME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <label class="control-label"><?php echo $income;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
										<tr>
                                            <td><label class="control-label">	13. If Physically Handicapped? Specify(Certificate to be enclosed)</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <label class="control-label"><?php echo $handi;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	14. Are you a Son/Daughter of Ex.Service men of Tamilnadu orgin?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <label class="control-label"><?php echo $exser;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	15. Are you of Tamilnadu orgin from Andaman Nicober Islands?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <label class="control-label"><?php echo $orgin;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">		16. DISTINCTION IN SPORTS/NCC/NSS</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <label class="control-label"><?php echo $sports;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			17. ADDRESS FOR COMMUNICATION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
											
											<label class="control-label"><?php echo $addr;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			18. Personal Mark on Indentification</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-8">
											<label class="control-label"><?php echo $tags;?></label>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">			19. Photo</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-8">
								<div class="fileupload fileupload-new">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $photo;?>" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    
                                    
                                </div>
                            </div>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
                                    </tbody>
                                </table>
					<center><a href="view.php" class="btn btn-info btn-lg btn-grad">Back</a></center>		</center>		
					
			 </div>
                           
                        </div>
                    </div>
                </div>
				
            </div>
			</form>

						
			
			
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
}
else {
header("Location:index.php");
}
?>