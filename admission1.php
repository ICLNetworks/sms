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
echo "Welcome....";
$course=$_POST['course'];
$shift=$_POST['shift'];
$adno=$_POST['adno'];

$addate=$_POST['addate'];
$admonth=$_POST['admonth'];
$adyear=$_POST['adyear'];

$doa=$addate."-".$admonth."-".$adyear;



$batch = $adyear;

$name=$_POST['name'];
$sex=$_POST['sex'];
$dob=$_POST['dob'];

$dobdate=$_POST['dobdate'];
$dobmonth=$_POST['dobmonth'];
$dobyear=$_POST['dobyear'];

$dob=$dobdate."-".$dobmonth."-".$dobyear;

//echo $dob;

$comm1=$_POST['comm'];
if($comm1=="Others"){
	$commtext=$_POST['commtext'];
	$comm=$commtext;
	$subc=$_POST['subctext'];
}else
{
	$comm=$comm1;
	$subc=$_POST['subc'];
}









$pschool=$_POST['pschool'];
$national=$_POST['national'];
$religion1=$_POST['religion'];
if($religion1=="Others"){
	$religiontext=$_POST['religiontext'];
	$religion=$religion1." &nbsp;&nbsp;&nbsp;&nbsp;".$religiontext;
}else
{
	$religion=$religion1;
}

$fm=$_POST['fm'];
$tho1=$_POST['tho'];
$tho2=$_POST['thotext'];

if($tho1=="yes")
{
	$tho=$tho1."&nbsp;&nbsp;&nbsp;".$tho2;
}
else
{
	$tho="No";
}


$income=$_POST['income'];
$handi1=$_POST['handi'];
$handi2=$_POST['handitext'];
if($handi1=="yes")
{
	$handi=$handi1."&nbsp;&nbsp;&nbsp;".$handi2;
}
else
{
	$handi="No";
}


$exser1=$_POST['exser'];
$exser2=$_POST['exsertext'];
if($exser1=="yes")
{
	$exser=$exser1."&nbsp;&nbsp;&nbsp;".$exser2;
}
else
{
	$exser="No";
}


$orgin1=$_POST['orgin'];
$orgin2=$_POST['orgintext'];
if($orgin1=="yes")
{
	$orgin=$orgin1."&nbsp;&nbsp;&nbsp;".$orgin2;
}
else
{
	$orgin="No";
}


$sports1=$_POST['sports'];
$sports2=$_POST['sportstext'];
if($sports1=="yes")
{
	$sports=$sports1."&nbsp;&nbsp;&nbsp;".$sports2;
}
else
{
	$sports="No";
}


$addr=$_POST['addr'];

$mark=$_POST['mark'];
echo $mark;
if($mark=="eng")
{
$tags11=$_POST['tags'];
$tags1=$_POST['tags1'];
}
else
{
$tags11=$_POST['tagst'];
$tags1=$_POST['tags1t'];
}


$tags="1. ".$tags11."& 2.".$tags1;

$dist1=$_POST['dist'];
if($dist1=="Others"){
	$disttext=$_POST['disttext'];
	$dist=$disttext;
}else
{
	$dist=$dist1;
}


$status="Not Issued";
 $id=$_GET['id'];

//$img1=$_POST['img1'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if($target_file=="uploads/")
{
	$target_file=$_POST['img1'];
	mysql_query("update register set name='$name', sex='$sex', dob='$dob', national='$national', religion='$religion', comm='$comm', subc='$subc', dist='$dist', fm='$fm', addr='$addr', tags='$tags', income='$income' where id='$id'")or die("COuld Perform query");
	header("location: adminview.php");
}else
{
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

mysql_query("update register set name='$name', sex='$sex', dob='$dob', national='$national', religion='$religion', comm='$comm', subc='$subc', dist='$dist', fm='$fm', addr='$addr', tags='$tags', income='$income', photo='$target_file' where id='$id'")or die("COuld Perform query");
header("location: adminview.php");
	
}
	

}




$editid=$_GET['id'];
$result = mysql_query("select * from register where id='$editid'");
while($row = mysql_fetch_array($result)) 
{
	$courseedit=$row['course'];
	$shiftedit=$row['shift'];
	$adnoedit=$row['adno'];
	$doaedit=$row['doa'];
	
	$nameedit=$row['name'];
	$sexedit=$row['sex'];
	$dobedit=$row['dob'];
	$commedit=$row['comm'];
	$subcedit=$row['subc'];
	
	$pschooledit=$row['pschool'];
	$nationaledit=$row['national'];
	$religionedit=$row['religion'];
	$distedit=$row['dist'];
	$fmedit=$row['fm'];
	$thoedit=$row['tho'];
	$incomeedit=$row['income'];
	$handiedit=$row['handi'];
	$exseredit=$row['exser'];
	$orginedit=$row['orgin'];
	$sportsedit=$row['sports'];
	$addredit=$row['addr'];
	$tagsedit=$row['tags'];
	$markedit=$row['mark'];
	$photoedit=$row['photo'];
	//$edit=$row['pschool'];
	
}
//echo $editid;



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
  if(document.form1.addate.value=="")
  {
	alert("Please enter the ADMISSION Date");
	document.form1.addate.focus();
	return false;
  }
  if(document.form1.admonth.value=="")
  {
	alert("Please enter the ADMISSION Month");
	document.form1.admonth.focus();
	return false;
  }
  if(document.form1.adyear.value=="")
  {
	alert("Please enter the ADMISSION Year");
	document.form1.adyear.focus();
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
  
  if(document.form1.dobdate.value.length=="")
  {
	alert("You must enter the date of the DATE of Birth");
	document.form1.dobdate.focus();
	return false;
  }

if(document.form1.dobmonth.value.length=="")
  {
	alert("You must enter the Month of the DATE of Birth");
	document.form1.dobmonth.focus();
	return false;
  }  
  if(document.form1.dobyear.value.length=="")
  {
	alert("You must enter the Year of the DATE of Birth");
	document.form1.dobyear.focus();
	return false;
  }
  
if(document.form1.national.value=="")
  {
    alert("Plese enter the nationality");
	document.form1.national.focus();
	return false;
  }
  
  if(document.form1.religion.value=="Select")
  {
    alert("Plese enter the RELIGION");
	document.form1.religion.focus();
	return false;
  }
  if(document.form1.religion.value=="Others")
  {
    alert("Plese enter the Reason of RELIGION");
	document.form1.religiontext.focus();
	return false;
  }
  
 if(document.form1.comm.value=="Select")
  {
    alert("Plese choose the community");
	document.form1.comm.focus();
	return false;
  }
 /* if(document.form1.subc.value=="")
  {
    alert("Plese enter the Sub Caste");
	document.form1.subc.focus();
	return false;
  }*/
  if(document.form1.pschool.value=="")
  {
    alert("Plese enter the previous school name");
	document.form1.pschool.focus();
	return false;
  }
  
  if(document.form1.dist.value=="Select")
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
  /*if(document.form1.tags.value=="")
  {
    alert("Plese enter the 1st Indentification");
	document.form1.tags.focus();
	return false;
  }
  if(document.form1.tags1.value=="")
  {
    alert("Plese enter the 2nd Indentification");
	document.form1.tags1.focus();
	return false;
  }*/

  
  
  if(document.form1.fileToUpload.value=="")
  {
    alert("Plese choose the Picture");
	document.form1.fileToUpload.focus();
	return false;
  }
  
return true;	
}

  </script>
	 <link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>
	
	 <script>
        $(function() {
			var bc = ["Select", "Sourastra", "Pattunulkarar"];
			var bcm = ["Select", "Mehtar", "Chamar"];
			var mbc = ["Select", "Devar", "Servar"];
			var sc = ["Select", "pallan", "paraiyan"];
			var st = ["Select", "Vishwakarma"];
			
			
           
            $('#thoyes').change(function() {
                $('#sitehtn').show()
             });
            $('#thono').change(function() {
                $('#sitehtn').hide()
                
            });
			
			$('#handiyes').change(function() {
                $('#handis').show()
             });
            $('#handino').change(function() {
                $('#handis').hide()
                
            });

			$('#exseryes').change(function() {
                $('#exsers').show()
             });
            $('#exserno').change(function() {
                $('#exsers').hide()
                
            });
			
			$('#orginyes').change(function() {
                $('#orgins').show()
             });
            $('#orginno').change(function() {
                $('#orgins').hide()
                
            });
			
			$('#sportsyes').change(function() {
                $('#sportss').show()
             });
            $('#sportsno').change(function() {
                $('#sportss').hide()
                
            });
			
			
			$('#religion').change(function() {
				var temp = $("#religion").val();
            if($("#religion").val() == 'Others')
			{
					//alert(temp);
					$('#religions').show()
			} else{
					$('#religions').hide()
			}   
                
            });
			
			$('#dist').change(function() {
				var temp = $("#dist").val();
            if($("#dist").val() == 'Others')
			{
					//alert(temp);
					$('#dists').show()
			} else{
					$('#dists').hide()
			}   
                
            });
			
			$('#comm').change(function() {
				var temp = $("#comm").val();
            if($("#comm").val() == 'Others')
			{
					//alert(temp);
					$('#comms').show();
					$('#subc').empty();
					$('#subc').hide();
					$('#subcs').show();
					
						
			} else{
					$('#comms').hide();
					
					if($("#comm").val() == 'BC')
					{
						$('#subc').empty();
						$('#subcs').hide();
					for(var i=0; i< bc.length;i++)
					{
	
					jQuery('<option/>', {
					value: bc[i],
					html: bc[i]
					}).appendTo('#dropdown select'); //appends to select if parent div has id dropdown
					}
					} else if($("#comm").val() == 'BC Muslim')
					{
						$('#subc').empty();
						$('#subcs').hide();
					for(var i=0; i< bcm.length;i++)
					{
	
					jQuery('<option/>', {
					value: bcm[i],
					html: bcm[i]
					}).appendTo('#dropdown select'); //appends to select if parent div has id dropdown
					}
					} else if ($("#comm").val() == 'MBC/DNC')
					{
						 $('#subc').empty();
						 $('#subcs').hide();
					for(var i=0; i< mbc.length;i++)
					{
	
					jQuery('<option/>', {
					value: mbc[i],
					html: mbc[i]
					}).appendTo('#dropdown select'); //appends to select if parent div has id dropdown
					}
					
					}  else if ($("#comm").val() == 'SC')
					{
						 $('#subc').empty();
						 $('#subcs').hide();
					for(var i=0; i< sc.length;i++)
					{
	
					jQuery('<option/>', {
					value: sc[i],
					html: sc[i]
					}).appendTo('#dropdown select'); //appends to select if parent div has id dropdown
					}
					
					}
					  else if ($("#comm").val() == 'ST')
					{
						 $('#subc').empty();
						 $('#subcs').hide();
					for(var i=0; i< st.length;i++)
					{
	
					jQuery('<option/>', {
					value: st[i],
					html: st[i]
					}).appendTo('#dropdown select'); //appends to select if parent div has id dropdown
					}
					
					}

			}   
                
            });
			
			$('#markeng').click(function(){
				$('#markenglish').show();
				$('#marktamil').hide();
				
			});
			$('#marktm').click(function(){
				$('#markenglish').hide();
				$('#marktamil').show();
				
			});
			
        });
		

	$(document).ready(function(){
	});
	
		</script>
	
	<style>
        #sitehtn, #handis, #exsers, #orgins, #sportss, #religions, #dists, #comms, #subcs, #marktamil, #markenglish {
            display: none
        }
		
	</style>
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
				<center style="color:red;"> Note: Same fields only you should edit. If you like to change any other details. You must delete the record then register again. </center>
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
                                                <?php echo $courseedit;?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                  
            
										<tr>
                                            <td><label class="control-label">SHIFT PREFERENCE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                                <?php echo $shiftedit;?>
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
											<?php echo $doaedit;?>
										
											
											</div>
											</div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">Admission Number</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                               <?php echo $adnoedit;?>
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
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $nameedit;?>">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">2.Gender</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                <?php 
												if($sexedit=="Male")
												{
													echo '<input type="radio" name="sex" id="sex" value="Male" checked/>Male&nbsp;&nbsp';
												echo '<input type="radio" name="sex" id="sex" value="Female" />Female&nbsp;&nbsp';
                                            
                                            
                                                echo '<input type="radio" name="sex" id="sex" value="Transgender" />Transgender';
												} else if($sexedit="Female")
												{
													echo '<input type="radio" name="sex" id="sex" value="Male" />Male&nbsp;&nbsp';
												echo '<input type="radio" name="sex" id="sex" value="Female" checked />Female&nbsp;&nbsp';
                                            
                                            
                                                echo '<input type="radio" name="sex" id="sex" value="Transgender" />Transgender';
												}
												else {
													echo '<input type="radio" name="sex" id="sex" value="Male" />Male&nbsp;&nbsp';
												echo '<input type="radio" name="sex" id="sex" value="Female"  />Female&nbsp;&nbsp';
                                            
                                            
                                                echo '<input type="radio" name="sex" id="sex" value="Transgender" checked/>Transgender';
												}
											?>
                                                
                                            
                                            
                                                
                                            
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">	3. DATE OF BIRTH</label></td>
                                            <td>
											
											<?php list($d,$m,$y)=explode('-',$dobedit);?>
											<pre><input type="number" name="dobdate" placeholder="Date"  min="01" max="31" value="<?php echo $d;?>"/>	<input type="number" name="dobmonth" placeholder="Month"  min="01" max="12" value="<?php echo $m;?>"/>	<input type="number" name="dobyear" placeholder="Year" min="1990" max="2040" value="<?php echo $y;?>"/>
											</pre>
											
											
											
											</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>        


										
										<tr>
                                            <td><label class="control-label">4. NATIONALITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class=" form-control" name="national" value="<?php echo $nationaledit;?>" id="national">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
							
										<tr>
                                            <td><label class="control-label">5. RELIGION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                           

						<select name="religion" id="religion" class="form-control" >
                                                <?php echo "<option selected>".$religionedit."</option>";?>
												<option>Select</option>
												
												<option>Hindu</option>
												<option>Muslim</option>
												<option>Christain</option>
												<option>Others</option>
												</select>
												<br>
												<input placeholder="Enter the Reason " type="text" class=" form-control" name="religiontext" id="religions" />


                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">6. COMMUNITY</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                                <select name="comm" id="comm" class="form-control">
                                                <?php echo "<option selected>".$commedit."</option>";?>
												<option>Select</option>
												<option>BC</option>
												<option>BC Muslim</option>
												<option>MBC/DNC</option>
												<option>SC</option>
												<option>ST</option>
												<option>Others</option>
												</select>
												<br>
												<input placeholder="Enter the Community Name " type="text" class="form-control" name="commtext" id="comms" />
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
                                    
										<tr>
                                            <td><label class="control-label">7.SUB CASTE</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
											<div id='dropdown'>
											<select name="subc" id="subc" class="form-control">
                                                <option>Select</option>
												<?php echo "<option selected>".$subcedit."</option>";?>
												
											</select>
											<br>
										<input placeholder="Enter the SubCommunity" type="text" class=" form-control" name="subctext" id="subcs" />

											</div>
											
											
                                            

                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
                                    
							            <tr>
                                            <td><label class="control-label">8. PREVIOUS SCHOOL NAME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
													<textarea id="autosize" class="form-control" name="pschool" id="pschool"><?php echo $pschooledit;?></textarea>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>

										
										<tr>
                                            <td><label class="control-label">	9. DISTRICT</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <select name="dist" id="dist" class="form-control">
                                                <?php echo "<option selected>".$distedit."</option>";?>
												<option>Select</option>
												<option>Ariyalur</option>
												<option>Chennai</option>
												<option>Coimbatore</option>
												<option>Cuddalore</option>
												<option>Dharmapuri</option>
												<option>Dindigul</option>
												<option>Erode</option>
												<option>Kanchipuram</option>
												<option>Karur</option>
												<option>Krishnagiri</option>
												<option>Madurai</option>
												<option>Nagapattinam</option>
												<option>Nagercoil</option>
												<option>Namakkal</option>
												<option>Perambalur</option>
												<option>Pudukkottai</option>
												<option>Ramanathapuram</option>
												<option>Salem</option>
												<option>Sivagangai</option>
												<option>Thanjavur</option>
												<option>Theni</option>
												<option>Thiruvallur</option>
												<option>Thiruvarur</option>
												<option>Thoothukudi</option>
												<option>Tiruchirappalli</option>
												<option>Tirunelveli</option>
												<option>Tiruppur</option>
												<option>Tiruvannamalai</option>
												<option>Udagamandalam (Ootacamund)</option>
												<option>Vellore</option>
												<option>Vilupuram</option>
												<option>Virudhunagar</option>
												<option>Others</option>
												
												</select>
												<br>
												<input placeholder="Enter the District " type="text" class=" form-control" name="disttext" id="dists" />


                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										<tr>
                                            <td><label class="control-label">	10. NAME OF FATHER/MOTHER/GUARDIAN</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
                                            <input type="text" class="form-control" name="fm"  id="fm" value="<?php echo $fmedit;?>">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	11. whether your Father/Mother/Guardian is <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Farmar/Agriculture Labourer/Registered Tanent?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <?php echo $thoedit; ?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	12. ANNUAL INCOME</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <input type="number" class="form-control" min="1000" name="income"  id="income" value="<?php echo $incomeedit;?>">
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
							
										<tr>
                                            <td><label class="control-label">	13. If Physically Handicapped? Specify(Certificate to be enclosed)</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <?php echo $handiedit; ?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	14. Are you a Son/Daughter of Ex.Service men of Tamilnadu orgin?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <?php echo $exseredit; ?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">	15. Are you of Tamilnadu orgin from Andaman Nicober Islands?</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <?php echo $orginedit; ?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">		16. DISTINCTION IN SPORTS/NCC/NSS</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-6">
                                            <?php echo $sportsedit; ?>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			17. ADDRESS FOR COMMUNICATION</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-12">
											
											<textarea name="addr" id="addr" id="autosize" class="form-control"><?php echo $addredit; ?></textarea>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										<tr><td></td><td></td></tr>
										
										<tr>
                                            <td><label class="control-label">			18. Personal Mark on Indentification</label></td>
                                            <td><div class="form-group">
                                           
										   
											<input type="radio" name="mark" id="markeng" value="eng" >English &nbsp; <input type="radio" id="marktm"  name="mark" value="tam">தமிழ் <p style="color:red">Reselect the button then automatically comes the marks.</p>
										   
											
											<?php
											list($a,$b)=explode("&",$tagsedit);
											
											if($markedit=="eng")
											{
												
											echo "<div class='col-lg-8' id='markenglish'>
											<input type='text' name='tags' value='$a' class='form-control' placeholder='Enter the 1st Indentification'/><br>
                                            <input type='text' name='tags1' value='$b' class='form-control' placeholder='Enter the 2nd Indentification'/>
											</div>";
											
											} else {
												
												echo "<div class='col-lg-8' id='marktamil' style='font-family: Bamini;'>
											<input type='text' name='tags' value='$a' class='form-control' placeholder='Enter the 1st Indentification'/><br>
                                            <input type='text' name='tags1' value='$b' class='form-control' placeholder='Enter the 2nd Indentification'/>
											</div>";
											}
												
											
											?>
                                        </div>
										</td>
                                            
                                        </tr>
										
										<tr><td></td><td></td></tr>
										
										
										
										<tr>
                                            <td><label class="control-label">			19. Photo</label></td>
                                            <td><div class="form-group">
                                            <div class="col-lg-8">
								<div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo $photoedit;?>" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="fileToUpload" id="fileToUpload"/></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
								<input type="hidden" name="img1" value="<?php echo $photoedit;?>"/>
                            </div>
                                            </div>
                                        </div>
										</td>
                                            
                                        </tr>
										
										
										
										
                                    </tbody>
                                </table>
					<center><input type="submit" value="Submit" name="submit" class="btn btn-primary btn-lg " />
						<input type="reset" class="btn btn-success  btn-lg btn-grad">
						<br><a href="home.php" class="btn btn-info btn-lg btn-grad">Back</a></center>		</center>		
					
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