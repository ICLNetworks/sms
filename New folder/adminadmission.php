<?php
@ob_start();
session_start();
?>
<?php
if(isset($_SESSION['login_user']))
{
include("includes/db.conn.php");
if (isset($_POST['submit'])) 
{
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1048576) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
echo "Welcome....";
$course=$_POST['course'];
$shift=$_POST['shift'];
$adno=$_POST['adno'];
$doa=$_POST['doa'];
$batch = substr($doa,6,4);
echo $batch;
$name=$_POST['name'];
$sex=$_POST['sex'];
$dob=$_POST['dob'];
$comm=$_POST['comm'];
$subc=$_POST['subc'];
$pschool=$_POST['pschool'];
$national=$_POST['national'];
$religion=$_POST['religion'];
$fm=$_POST['fm'];
$tho=$_POST['tho'];
$income=$_POST['income'];
$handi=$_POST['handi'];
$exser=$_POST['exser'];
$orgin=$_POST['orgin'];
$sports=$_POST['sports'];
$addr=$_POST['addr'];
$tags=$_POST['tags'];
$dist=$_POST['dist'];
$status="Not Issued";
//header("location: admissionview.php");
//$fileToUpload=$_POST['fileToUpload'];

echo "";
//$nnn=Date('d-m-Y'); 	
//$date=date("d-m-y h:i:sa");
//$query1="insert into tex_design(doa,name,sex,dob,comm,subc,pschool,national,religion,dist,fm,tho,income,handi,exser,orgin,sports,addr,tags,photo) values($course,$shift,$doa,$name,$sex,$dob,$comm,$subc,$pschool,$national,$religion,$dist,$fm,$tho,$income,$handi,$exser,$orgin,$sports,$addr,'$tags',$target_file)";
$query1="insert into register(course,shift,adno,doa,name,sex,dob,comm,subc,pschool,national,religion,dist,fm,tho,income,handi,exser,orgin,sports,addr,tags,photo,status,batch) values('$course','$shift','$adno','$doa','$name','$sex','$dob','$comm','$subc','$pschool','$national','$religion','$dist','$fm','$tho','$income','$handi','$exser','$orgin','$sports','$addr','$tags','$target_file','$status','$batch')";
$result1 = mysql_query($query1) or die(mysql_error());
header("location: view.php");
}

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
  if(document.form1.adno.value=="")
  {
	alert("Please enter the ADMISSION NUMBER");
	document.form1.adno.focus();
	return false;
  }
    
 if(document.form1.name.value=="")
  {
	alert("Please Enter the Name");
	document.form1.name.focus();
	return false;
  }
	if(document.form1.name.value.length==1)
  {
	alert("You must enter the full name");
	document.form1.name.focus();
	return false;
  }
	
		
	
	if(document.form1.sex.value=="")
  {
	alert("Please choose the sex");
	return false;
  }	
var d = new Date();
var curr_date = d.getDate();
var curr_month = d.getMonth()+1;
var curr_year = d.getFullYear();
if(curr_date<10)
{
	curr_date="0"+curr_date;
}
if(curr_month<10)
{
	curr_month="0"+curr_month;
}
var da=curr_date + "-" + curr_month + "-" + curr_year;
//document.write(da);
var old_year=d.getFullYear()-15;
var da1=curr_date + "-" + curr_month + "-" + old_year;

  if(document.form1.dob.value==da)
  {
	alert("Please enter correct date of birth");
	document.form1.dob.focus();
	return false;
  }
  
  /*if(document.form1.dob.value<=da1 && document.form1.dob.value>=da)
  {
	alert("Please enter correct date of birth");
	document.form1.dob.focus();
	return false;
  }*/
  
 if(document.form1.comm.value=="Select")
  {
    alert("Plese choose the community");
	document.form1.comm.focus();
	return false;
  }
  if(document.form1.subc.value=="")
  {
    alert("Plese enter the Sub Caste");
	document.form1.subc.focus();
	return false;
  }
  if(document.form1.pschool.value=="")
  {
    alert("Plese enter the previous school name");
	document.form1.pschool.focus();
	return false;
  }
  if(document.form1.national.value=="")
  {
    alert("Plese enter the nationality");
	document.form1.national.focus();
	return false;
  }
  if(document.form1.religion.value=="")
  {
    alert("Plese enter the RELIGION");
	document.form1.religion.focus();
	return false;
  }
  if(document.form1.dist.value=="")
  {
    alert("Plese enter the DISTRICT NAME");
	document.form1.dist.focus();
	return false;
  }
  if(document.form1.fm.value=="")
  {
    alert("Plese enter the Father/Mother/Guardian NAME");
	document.form1.fm.focus();
	return false;
  }
  if(document.form1.tho.value=="")
  {
    alert("Plese enter the No.11");
	return false;
  }
  if(document.form1.income.value=="")
  {
    alert("Plese enter the ANNUAL INCOME");
	document.form1.income.focus();
	return false;
  }
  if(document.form1.handi.value=="")
  {
    alert("Plese choose the No.13");
	return false;
  }
  if(document.form1.exser.value=="")
  {
    alert("Plese choose the No.14");
	return false;
  }
  if(document.form1.orgin.value=="")
  {
    alert("Plese choose the No.15");
	return false;
  }
  if(document.form1.sports.value=="")
  {
    alert("Plese choose the No.16");
	return false;
  }
  if(document.form1.addr.value=="")
  {
    alert("Plese enter the Address of the student");
	document.form1.addr.focus();
	return false;
  }
  if(document.form1.tags.value=="")
  {
    alert("Plese enter the No. 18");
	document.form1.tags.focus();
	return false;
  }
  
  if(document.form1.fileToUpload.value=="")
  {
    alert("Plese choose the Picture");
	document.form1.fileToUpload.focus();
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
		<form  id="block-validate" enctype="multipart/form-data" name="form1" method="post" onSubmit="return check();">
		<div class="row">
		
                <div class="col-lg-12">
				<center><h3><b>ADMISSION REGISTERATION</b> </h3></center>
				<center><h5><b>Application form for admission to B.Sc.,/B.A.,/B.Com., courses under Choice Based Credit System(CBCS)</b> </h5></center>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
						                    <B>Basic Details<B>
<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>							
<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="view.php">View</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;							
							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="index1.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							
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
												<option>BA History</option>
												<option>BBA</option>
												<option>B.Com (CS)</option>
												<option>B.Sc Maths</option>
												<option>B.Sc Chemistry</option>
												<option>B.Sc Bio-Chemistry</option>
												<option>B.Sc Comp.Science</option>
												<option>B.Sc Electronics</option>
												<option></option>
												<option>MA Tamil</option>
												<option>MA English</option>
												<option>M.Com</option>
												<option>M.Sc Maths</option>
												<option>M.Sc Bio-Chemistry</option>
												<option>M.Sc Comp.Science</option>
												<option>M.Sc Electronics</option>
												<option>MBA</option>
												<option></option>
												<option>M.Phil Tamil</option>
												<option>M.Phil Electronics</option>
												<option>M.Phil Commerce</option>
												<option>M.Phil Management</option>

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
                                            <td><label class="control-label">DATE OF ADMISSION</label></td>
                                            <td>
											<div class="form-group">
											<div class="col-lg-6">
											<div class="input-group input-append date" id="dp3" data-date=<?php echo date('d-m-Y');?> data-date-format="dd-mm-yyyy">
											<input name="doa" id="doa" class="form-control" type="date" value=<?php echo date('d-m-Y');?> />                                
											</div>
											</div>
											</div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">Admission Number</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="adno" id="adno">
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
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">2.SEX</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                
                                                <input type="radio" name="sex" id="sex" value="Male"/>Male&nbsp;&nbsp;
                                            
                                            
                                                <input type="radio" name="sex" id="sex" value="Female" />Female&nbsp;&nbsp;
                                            
                                            
                                                <input type="radio" name="sex" id="sex" value="Transgender" />Transgender
                                            
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
											<div class="input-group input-append date" id="dp2" data-date=<?php echo date('d-m-Y');?> data-date-format="dd-mm-yyyy">
											<input class="form-control" type="date" value=<?php echo date('d-m-Y');?> name="dob" id="dob"/>      
											</div>
											</div>
											</div>
											</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>        
										
										<tr>
                                            <td><label class="control-label">4. COMMUNITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <select name="comm" id="comm" class="form-control">
                                                <option>Select</option>
												<option>OC</option>
												<option>BC</option>
												<option>BC Muslim</option>
												<option>MBC/DNC</option>
												<option>SC</option>
												<option>ST</option>
												</select>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">5.SUB CASTE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" name="subc" id="subc">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
							            <tr>
                                            <td><label class="control-label">6. PREVIOUS SCHOOL NAME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
													<textarea id="autosize" class="form-control" name="pschool" id="pschool"></textarea>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">7. NATIONALITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class=" form-control" name="national" value="Indian" id="national">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
							
										<tr>
                                            <td><label class="control-label">8. RELIGION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class="form-control" name="religion" id="religion">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	9. DISTRICT</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class="form-control" id="dist" name="dist">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">	10. NAME OF FATHER/MOTHER/GUARDIAN</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class="form-control" name="fm"  id="fm">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	11. whether your Father/Mother/Guardian is <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Farmar/Agriculture Labourer/Registered Tanent?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="radio" name="tho" id="tho" value="yes">Yes &nbsp; <input type="radio" name="tho" id="tho" value="no">No
											<input type="hidden" name="tho1">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	12. ANNUAL INCOME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="number" class="form-control" min="1000" name="income"  id="income">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
										<tr>
                                            <td><label class="control-label">	13. If Physically Handicapped? Specify(Certificate to be enclosed)</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="radio" name="handi" id="handi" value="yes">Yes &nbsp; <input type="radio" name="handi" id="handi" value="no">No
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	14. Are you a Son/Daughter of Ex.Service men of Tamilnadu orgin?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="radio" name="exser" id="exser" value="yes">Yes &nbsp; <input type="radio" name="exser" id="exser" value="no">No
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	15. Are you of Tamilnadu orgin from Andaman Nicober Islands?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="radio" name="orgin" id="orgin" value="yes">Yes &nbsp; <input type="radio" name="orgin" id="orgin"value="no">No
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">		16. DISTINCTION IN SPORTS/NCC/NSS</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="radio" name="sports" id="sports" value="yes">Yes &nbsp; <input type="radio" name="sports" id="sports" value="no">No
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			17. ADDRESS FOR COMMUNICATION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
											
											<textarea name="addr" id="addr" id="autosize" class="form-control"></textarea>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			18. Personal Mark on Indentification</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-8">
											<input name="tags" id="tags" value="" class="form-control" />
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">			19. Photo</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-8">
								<div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/demoUpload.jpg" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="fileToUpload" id="fileToUpload"/></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
                                    </tbody>
                                </table>
					<center><input type="submit" value="Submit" name="submit" class="btn btn-primary btn-lg " />
						<input type="reset" class="btn btn-success  btn-lg btn-grad">
						<br><a href="index1.php" class="btn btn-info btn-lg btn-grad">Back</a></center>		</center>		
					
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