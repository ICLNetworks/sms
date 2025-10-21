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
<link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- END PAGE LEVEL  STYLES -->

	 <link rel="stylesheet" href="assets/css/countdown.css" />
     <!-- END PAGE LEVEL STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
	<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin-top: -20mm;  /* this affects the margin in the printer settings */
		margin-bottom: 0mm;
		margin-left: 0.5mm;
		margin-right: 1mm;
    }
</style>

</head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
<body >
      <!--MAIN CONTAINER --> 
	  <a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>							

							<button  onclick="print();">Print</button>
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		<center><h3><b>ADMISSION REGISTER</b> </h3></center>
	                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                       <table border="1px"  id="DivIdToPrint" >
                                <tr><td>
										<table border="1px" width="100%" style="font-size: 10px;">
										
										<tr align="center">
                                            <th>S.No</th>
											<th>Course<br>Shift</th>
											<th>Date of Admission</th>
											<th>Admission Number</th>
											<th>Name</th>
											<th>Sex</th>
											<th width="60px;">Date of Birth</th>
											<th>Community/Sub Caste</th>
											<th>Previous<br> school Name</th>
											<th>Nationality<br>Religion</th>
											<th>District</th>
											<th>Father<br>Mother<br>Guardian</th>
											<th>ADDRESS</th>
											<th>Indentification</th>
											<th>Date of Leave</th>
											<th>Date of Apply</th>
											<th>Date of Issue</th>
											<th>Principal<br> Sign</th>
											<th>Photo</th>
									</tr>
                                    </thead>
                                    <tbody>
										                                      
									   <?php
										$batch=$_POST['batch'];
										$course=$_POST['course'];
										$shift=$_POST['shift'];

																						$result = mysql_query("SELECT * FROM register where course='$course' && shift='$shift' && batch='$batch'");												
												$sno=1;
												while($row = mysql_fetch_array($result)) 
											  {
											  $id=$row['id'];
											  echo "<tr class='odd'> ";
											  
											  echo "<td>".$sno."</td>";
											  echo "<td>".$row['course']."<br>".$row['shift']."</td>";
											  echo "<td>".$row['doa']."</td>";
											  echo "<td>".$row['adno']."</td>";
											  echo "<td>".$row['name']."</td>";
											  echo "<td>".$row['sex']."</td>";
											  echo "<td width='70px'>".$row['dob']."</td>";
											  echo "<td>".$row['comm']."/".$row['subc']."</td>";
											  echo "<td>".$row['pschool']."</td>";
											  echo "<td>".$row['national']."<br>".$row['religion']."</td>";
											  echo "<td>".$row['dist']."</td>";
											  echo "<td>".$row['fm']."</td>";
											  echo "<td>".$row['addr']."</td>";
											  
											  $tags=$row['tags'];
											  $mark=$row['mark'];
											  
											list($m1, $m2) = explode("&", $tags);
											if($mark=="tam")
											{
												echo "<td style='font-family: Bamini;'>".$m1."<br>".$m2."</td>";
											}
											else{
												echo "<td>".$m1."<br>".$m2."</td>";
											}
										
											$results = mysql_query("SELECT * FROM tc where id='$id'");												
											$rows=mysql_num_rows($results);
											if($rows==1)
											{
											while($rows = mysql_fetch_array($results)) 
											  {
											  echo "<td>".$rows['dol']."</td>";
											  echo "<td>".$rows['apply']."</td>";
											  echo "<td>".$rows['idate']."</td>";
											  
											  }
											 }
											else{
											  echo "<td> - </td>";
											  echo "<td> - </td>";
											  echo "<td> - </td>";
											}
											  
											  echo "<td></td>";
											  echo "<td class='fileupload-new thumbnail' style='height:75px!important; width:75px!important;' ><img src='".$row['photo']."'></td>";
											  
											  echo "</tr>";
											 $sno++;
											 }
											  ?>
											  </table>
											</td>
									</tr></table>	
                                    </tbody>
                                </table>
					

		<!--<center>					<input type='button' id='btn' value='Print' onclick='printDiv();'></center>-->
    


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
<script>
		function printDiv() 
			{

			  var divToPrint=document.getElementById('DivIdToPrint');

			  var newWin=window.open('','Print-Window');

			  newWin.document.open();

			  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

			  newWin.document.close();

			  setTimeout(function(){newWin.close();},10);

			}
		
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