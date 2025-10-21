<?php
@ob_start();
session_start();
?>
<?php
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
<script>
	function devPrint()
	{
	window.print();
	}


function check()
{
if(document.form1.course.value=="Select" || document.form1.course.value=="")
  {
	alert("Please choose the course");
	document.form1.course.focus();
	return false;
  }

if(document.form1.shift.value=="Select")
  {
	alert("Please choose the Shift");
	document.form1.shift.focus();
	return false;
  }
  
if(document.form1.batch.value=="Select")
  {
	alert("Please choose the batch");
	document.form1.batch.focus();
	return false;
  }
return true;	
}

  </script>
	
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
		<form  id="block-validate" action="register1.php" name="form1" method="post" onSubmit="return check();">
		<div class="row">
		
                <div class="col-lg-12">
				<center><h3><b>Transfer Certificate Issued</b> </h3></center>
				</center>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
						                    <B>Basic Details<B>
<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>							

							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                        <tr>
                                            <td><label class="control-label">COURSE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <select name="course"  class="form-control" >
                                               <option>Select</option>
												<option>BA Tamil</option>
												<option>BA English</option>
												<option>B.Com (CS)</option>
												<option>B.Sc Maths</option>
												<option>B.Sc Home Science</option>
												<option>B.Sc Comp.Science</option>
												<option>B.Sc Electronics</option>
												<option></option>
												
												<option>M.Sc Maths</option>
												
												<option>M.Sc Comp.Science</option>
												<option>M.Com (CS)</option>

                                                </select>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">SHIFT PREFERENCE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <select name="shift" id="shift" required class="form-control">
                                                <option>Select</option>
												<option>Shift I</option>
												<option>Shift II</option>
												</select>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										
										
										<tr>
                                            <td><label class="control-label">Batch</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                        
												<select name="batch" id="batch" required class="form-control">
                                                <option>Select</option>
												<?php 
												
												for($i=2000;$i<=date('Y');$i++)
												{
													echo "<option>$i</option>";
												}
												?>
												</select>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										                                   
                                    </tbody>
                                </table>
								<center><input type="submit" value="Submit" name="submit" class="btn btn-primary btn-lg " />
						<input type="reset" class="btn btn-success  btn-lg btn-grad">
						</center>		
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
else {
header("Location:index.php");
}
?>