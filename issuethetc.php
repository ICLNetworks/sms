<?php
include("includes/db.conn.php");
$id=$_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM register1 where id='$id'");
while($row = mysqli_fetch_array($result)) 
 {
$course=$row['course'];
$shift=$row['shift'];
$doa=$row['doa'];
$name=$row['name'];
$sex=$row['sex'];
$dob=$row['dob'];
$comm=$row['comm'];
$subc=$row['subc'];

$national=$row['national'];
$religion=$row['religion'];
$tags=$row['tags'];
$photo=$row['photo'];
$dist=$row['dist'];
$adno=$row['adno'];
$batch=$row['batch'];
$status=$row['status'];
$mark=$row['mark'];

}

$yy = date('Y');
$yea = $batch +3;

    if($yea<=$yy)
     $yr = "3 years";
   else
    $yr = "Dis-continue";


if (isset($_POST['submit'])) 
{
//$dobw=$_POST['dobw'];
$sublev=$_POST['sublev'];
$aucsub=$_POST['aucsub'];
$part11=$_POST['part1'];
if($part11=="Other"){
	$part1text=$_POST['part1text'];
	$part1=$part11." ".$part1text;
}else
{
	$part1=$part11;
}
//echo $part1;

$medium=$_POST['medium'];
$paid=$_POST['paid'];

$scholar1=$_POST['scholar'];
$scholar2=$_POST['scholartext'];
if($scholar1=="Yes")
{
	$scholar=$scholar1." ".$scholar2;
}
else
{
	$scholar="No";
}
$medical1=$_POST['medical'];
$medical2=$_POST['medicaltext'];
if($medical1=="Yes")
{
	$medical=$medical1." ".$medical2;
}
else
{
	$medical="No";
}

echo $medical;

$medical=$_POST['medical'];

$doldate=$_POST['doldate'];
$dolmonth=$_POST['dolmonth'];
$dolyear=$_POST['dolyear'];

$dol=$doldate."-".$dolmonth."-".$dolyear;

echo $dol;


$applydate=$_POST['applydate'];
$applymonth=$_POST['applymonth'];
$applyyear=$_POST['applyyear'];

$apply=$applydate."-".$applymonth."-".$applyyear;

$idatedate=$_POST['idatedate'];
$idatemonth=$_POST['idatemonth'];
$idateyear=$_POST['idateyear'];

$idate=$idatedate."-".$idatemonth."-".$idateyear;
echo $idate;
$noy=$_POST['noy'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
$academic=$sdate."-".$edate;
$flang=$_POST['flang'];
$tmedium=$_POST['tmedium'];
$sublevyear=$_POST['sublevyear'];
$dis=$_POST['dis'];
$nnn=Date('d-m-Y'); 	

//$status="Not Issued";


$query1="insert into tc(sublev,aucsub,part1,medium,paid,scholar,medical,dol,apply,idate,noy,academic,flang,tmedium,id,date,sublevyear,dis) values('$sublev','$aucsub','$part1','$medium','$paid','$scholar','$medical','$dol','$apply','$idate','$noy','$academic','$flang','$tmedium','$id','$nnn','$sublevyear','$dis')";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn,));
$query1="update register1 set status='Iussed on $nnn' where id='$id'";
	$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn,));
	$id=$_GET['id'];
	?>
<script type="text/javascript">
   var id = "<?php echo $id; ?>";
   
   window.location= "tc.php?id="+id;
   
</script>
<?php	
   //header("Location: tc.php?id=$id");

}

function convertNumber($num)
{
//list($num, $dec) = explode(".", $num);

$output = "";

if($num[0] == "-")
{
$output = "negative ";
$num = ltrim($num, "-");
}
else if($num[0] == "+")
{
$output = "positive ";
$num = ltrim($num, "+");
}

if($num[0] == "01")
{
$output .= "one";
}
else
{
$num = str_pad($num, 36, "0", STR_PAD_LEFT);
$group = rtrim(chunk_split($num, 3, " "), " ");
$groups = explode(" ", $group);

$groups2 = array();
foreach($groups as $g) $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);

for($z = 0; $z < count($groups2); $z++)
{
if($groups2[$z] != "")
{
$output .= $groups2[$z].convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
&& $groups2[11] != '' && $groups[11][0] == '0' ? " and " : ", ");
}
}

$output = rtrim($output, ", ");
}

/*if($dec > 0)
{
$output .= " point";
for($i = 0; $i < strlen($dec); $i++) $output .= " ".convertDigit($dec{$i});
}*/

return $output;
}

function convertGroup($index)
{
switch($index)
{
case 11: return " decillion";
case 10: return " nonillion";
case 9: return " octillion";
case 8: return " septillion";
case 7: return " sextillion";
case 6: return " quintrillion";
case 5: return " quadrillion";
case 4: return " trillion";
case 3: return " billion";
case 2: return " million";
case 1: return " thousand";
case 0: return "";
}
}

function convertThreeDigit($dig1, $dig2, $dig3)
{
$output = "";

if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";

if($dig1 != "0")
{
$output .= convertDigit($dig1)." hundred";
if($dig2 != "0" || $dig3 != "0") $output .= " and ";
}

if($dig2 != "0") $output .= convertTwoDigit($dig2, $dig3);
else if($dig3 != "0") $output .= convertDigit($dig3);

return $output;
}

function convertTwoDigit($dig1, $dig2)
{
if($dig2 == "0")
{
switch($dig1)
{
case "1": return "ten";
case "2": return "twenty";
case "3": return "thirty";
case "4": return "forty";
case "5": return "fifty";
case "6": return "sixty";
case "7": return "seventy";
case "8": return "eighty";
case "9": return "ninety";
}
}
else if($dig1 == "1")
{
switch($dig2)
{
case "1": return "eleven";
case "2": return "twelve";
case "3": return "thirteen";
case "4": return "fourteen";
case "5": return "fifteen";
case "6": return "sixteen";
case "7": return "seventeen";
case "8": return "eighteen";
case "9": return "nineteen";
}
}
else
{
$temp = convertDigit($dig2);
switch($dig1)
{
case "2": return "twenty-$temp";
case "3": return "thirty-$temp";
case "4": return "forty-$temp";
case "5": return "fifty-$temp";
case "6": return "sixty-$temp";
case "7": return "seventy-$temp";
case "8": return "eighty-$temp";
case "9": return "ninety-$temp";
}
}
}

function convertDigit($digit)
{
switch($digit)
{
case "0": return "zero";
case "1": return "one";
case "2": return "two";
case "3": return "three";
case "4": return "four";
case "5": return "five";
case "6": return "six";
case "7": return "seven";
case "8": return "eight";
case "9": return "nine";
}
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
<link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />   
<link rel="stylesheet" href="assets/plugins/switch/static/stylesheets/bootstrap-switch.css" />
    <!-- END PAGE LEVEL  STYLES -->

	 <link rel="stylesheet" href="assets/css/countdown.css" />
     <!-- END PAGE LEVEL STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
 <script src="js/jquery-ui.js"></script>
	
	 <script>
        $(function() {
           
			$("#mediums").change(function(){
				var med=$("#mediums").val();
				$("#tmedium").val(med);
			});
			
            $('#part1').change(function() {
				var temp=$("#part1").val();
				$("#flang").val(temp);
			if($("#part1").val() == 'Other')
			{
					//alert(temp);
					$('#part1s').show()
			} else{
					$('#part1s').hide()
			}   
                
            });
			$('#scholaryes').change(function() {
                $('#scholars').show()
             });
            $('#scholarno').change(function() {
                $('#scholars').hide()
                
            });
			
			$('#medicalyes').change(function() {
                $('#medicals').show()
             });
            $('#medicalno').change(function() {
                $('#medicals').hide()
                
            });
			
			
                
            
			
        });
		
    </script>
	
	<style>
        #part1s,#scholars,#medicals {
            display: none
        }
		
	</style>





	<script>
	function devPrint()
	{
	window.print();
	}


function check()
{
if(document.form1.sublevyear.value=="Select")
  {
	alert("Please enter the Leaving Year");
	document.form1.sublevyear.focus();
	return false;
  } 
  
  
if(document.form1.sublev.value=="")
  {
	alert("Please enter the 10(a)");
	document.form1.sublev.focus();
	return false;
  }
  if(document.form1.aucsub.value=="")
  {
	alert("Please enter the 10(b)");
	document.form1.aucsub.focus();
	return false;
  }
    
 if(document.form1.part1.value=="Select")
  {
	alert("Please enter the 10(c)");
	document.form1.part1.focus();
	return false;
  }
 if(document.form1.part1.value=="Other")
  {
    alert("Plese enter the name of the Part 1");
	document.form1.part1text.focus();
	return false;
  }	
 if(document.form1.medium.value=="Select")
  {
	alert("Please enter the 10(d)");
	document.form1.medium.focus();
	return false;
  } 
    if(document.form1.paid.value=="")
  {
	alert("Please enter the 11 field");
	return false;
  }
  
 if(document.form1.scholar.value=="")
  {
    alert("Plese enter the 12 field");
	document.form1.scholar.focus();
	return false;
  }
  if(document.form1.medical.value=="")
  {
    alert("Plese enter the 13 field");
	document.form1.medical.focus();
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

  if(document.form1.doldate.value=="")
  {
    alert("Plese Enter the Date of the date of leaving");
	document.form1.doldate.focus();
	return false;
  }
 if(document.form1.dolmonth.value=="")
  {
    alert("Plese Enter the MONTH of the date of leaving");
	document.form1.dolmonth.focus();
	return false;
  }
  if(document.form1.dolyear.value=="")
  {
    alert("Plese Enter the YEAR of the date of leaving");
	document.form1.dolyear.focus();
	return false;
  }
  
  if(document.form1.applydate.value=="")
  {
    alert("Plese Enter the Date");
	document.form1.applydate.focus();
	return false;
  }
 if(document.form1.applymonth.value=="")
  {
    alert("Plese Enter the MONTH");
	document.form1.applymonth.focus();
	return false;
  }
  if(document.form1.applyyear.value=="")
  {
    alert("Plese Enter the YEAR");
	document.form1.applyyear.focus();
	return false;
  }
  
   
	if(document.form1.idatedate.value=="")
  {
    alert("Plese Enter the Date");
	document.form1.idatedate.focus();
	return false;
  }
 if(document.form1.idatemonth.value=="")
  {
    alert("Plese Enter the MONTH");
	document.form1.idatemonth.focus();
	return false;
  }
  if(document.form1.idateyear.value=="")
  {
    alert("Plese Enter the YEAR");
	document.form1.idateyear.focus();
	return false;
  }
  
  
  
  if(document.form1.noy.value=="")
  {
    alert("Plese choose the 18 field");
	document.form1.noy.focus();
	return false;
  }
  
   if(document.form1.edate.value==document.form1.sdate.value)
  {
    alert("Plese choose the academic Ending Year");
	document.form1.edate.focus();
	return false;
  }
  
  if(document.form1.flang.value=="")
  {
    alert("Plese Enter the First Language");
	document.form1.flang.focus();
	return false;
  }
  if(document.form1.tmedium.value=="")
  {
    alert("Plese Enter the Medium Instruction");
	document.form1.tmedium.focus();
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
    
          
    
	<div id="main"> 
	
        <!-- PAGE CONTENT --> 
      <div class="container">
       
        
		

        <div id="" class="row">
		<form  id="block-validate" enctype="multipart/form-data" name="form1" method="post" onSubmit="return check();">
		<div class="row">
		
                <div class="col-lg-12">
				<div style="letter-spacing:5px;"><center><h4><b>தமிழ்நாடு அரசு<br><Br>Government of Tamil Nadu<br><br>கல்லுரிக் கல்வித் துறை <br><br>Department of Collegiate Education</b> </h4></center></div>
				
                    <div class="panel panel-primary">
                        <div class="panel-heading">
						<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="logout.php">Logout</a>							

							<a class="btn btn-danger btn-sm btn-line" style="float:right!important;" href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						                    <H4><center><B>மாற்றுச் சான்றிதழ் - TRANSFER CERTIFICATE<B></center></H4>

							
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
							<table width="100%">
							<tr>
								<td width="15%;">வரிசை எண்:<br>Serial No:  </td>
								<td width="35%;"><h4><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $id+6000;?><b></h3></td>
								
								<td width="15%;">சேர்க்கை எண்:<br> Admission No:</td>
								<td width="15%;"><h4><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $adno;?><b></h3></td>
								<td></td>
							<tr>
							</table>
							
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tbody>
                                       <tr>
<td>1. (அ) கல்லூரியின் பெயர்:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name of the College:<br>
&nbsp;&nbsp;&nbsp;&nbsp;(ஆ) மாவட்டத்தின் பெயர் <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of the District</td>
<td width=50% align=center colspan="2"><b>GOVT. ARTS COLLEGE<br>PARAMAKUDI-623701<br><br><b>Ramanathapuram</td>

</tr>
										<tr><td></td><td></td></tr>
										
<tr>
<td><pre>2. மாணவர் பெயர் (தனித்தனி எழுத்துக்களில்)<br><font face="arial" size=2>     Name of public (in BLOCK LETTERS)<br>    (as entered in +2 or equivalent certificate)</font>
</td>
<td width="25%"><center><b><?php echo strtoupper($name); ?></center></td>
<td width="15%"><div class="fileupload fileupload-new" style="width: 200px!important; height: 150px!important;">
                                <?php echo "<img style='width: 200px!important; height: 150px!important;' src='$photo'/>";?>
								
                                
                                <div>
                                    
                                    
                                </div>
                            </div></td>
</tr>

<!-- <tr>
<td><pre>3. தந்தை அல்லது தாயின் பெயர்:<br><font face="arial" size=2>     Name of Father or Mother</font></pre></td>
<td  colspan="2"><b><center><?php echo "<br>".strtoupper($fm); ?></center></td>
</tr>
<tr>
<td><pre>4. தேசீய இனம் சமயம் மற்றும் சாதி <br><font face="arial" size=2>     Nationality Religion and Caste</font></pre></td>
<td  colspan="2"><center><b><?php echo "<br>".strtoupper($national).", ".strtoupper($religion)." ,".strtoupper($comm);?></center></td>
</tr>
<tr>
<td><pre>5. இனம் <font face="arial" size=2>(community)</font>
  அவன் / அவள் பின்வரும் ஐந்து பிரிவுகளில் எவையேனும் 
    ஒன்றைச் சார்ந்தவரா? 
<font face="arial" size=2>    Whether he/she belongs to-</font>
(அ) ஆதி திராவிடர் அல்லது பழங்குடி:
<font face="arial" size=2>         Adi Dravidar (Shcheduled Caste or Schedule Tribe)</font>
(ஆ) பின்தங்கிய வகுப்பு:
<font face="arial" size=2>         Backward Class</font>
(இ) மிகவும் பின்தங்கிய வகுப்பு :
<font face="arial" size=2>         Most Backward Class</font>
(ஈ) ஆதிதிராவிடர் இனத்திலிருந்து கிறித்துவ மதத்திற்கு 
    மாறியவர் அல்லது :
<font face="arial" size=2>       Converted to Christianity from Scheduled Caste or</font>
(உ) அட்டவணையிலிருந்து நீக்கப்பட்ட இனம்: 
<font face="arial" size=2>        Denotified Tribes</font>
    
   மாணவர்/மாணவியர் மேற்குறிப்பிட்ட ஐந்து பிரிவுகளில்
   ஏதாவது ஒன்றைச் சார்ந்தவராக இருந்தால் அந்தப்
   பிரிவுக்கு எதிரே "ஆம்" என்று எழுத வேண்டும்: 

<font face="arial" size=2>      If the belongs to any one of the five catagories mentioned
      above. Write "Yes" against the relevent column:</font></pre>
<td align=center valign="top"  colspan="2">
<?php
$a = "";
$sc="";
$st="";
$bc="";
$mbc="";
$other="";

if($comm=="OC")
$other="Yes, OC Category";
else
if($comm=="BC")
$bc="Yes, Backward Class";
else
if($comm=="BC Muslim")
$bc="Yes, Backward Class MUSLIM";
else
if($comm=="SC")
$sc="Yes, Scheduled Caste";
else
if($comm=="ST")
$sc="Yes, Scheduled Tribe";
else
if($comm=="MBC/DNC")
$mbc="Yes, Most Backward Class";


echo "<br>$a<br><br>$sc$st<br><br><br>$bc<br><br>$mbc<br><br>$other";
?>
</pre>
</td>
</tr> 
<tr><td><pre>6. பாலினம் 
<font face="arial" size=2>     Sex :</font>
    
</pre></td>
<td align=center  colspan="2"><b><center><?Php echo "<br>".strtoupper($sex); ?></center></td>
</tr> -->

<tr><td><pre>7. பிறந்த தேதி எண்ணிலும் எழுத்திலும்:
   (மாணவர் சேர்க்கைப் பதிவேட்டில் உள்ளத்துப்படி):
   <font face="arial" size=2> Date of Birth as entered in the Admission Register 
      in figures and words</font> 
</pre></td>
<td align=center  colspan="2"><b><center><?php

list($d,$m,$y)=explode("-",$dob);
$d2 = convertNumber($d);
$m2 = convertNumber($m);
$y2 = convertNumber($y);
$fin="$d2-$m2-$y2";

echo "$dob <br>".strtoupper($fin); ?></center></td>
</tr>


<tr><td><pre>8. உடலில் அமைந்த அடையாளக் குறிப்புகள்:
<font face="arial" size=2>       Personal Marks of Identification</font>
</td>
<td align=center  colspan="2">

<b><?php 

list($m1, $m2) = explode("&", $tags);
											
											if($mark=="tam")
											{
												echo "<div style='font-family: Bamini;'>".$m1."<br>".$m2."</div>";
											}
											else{
												echo "<div>".$m1."<br>".$m2."</div>";
											}
										

 ?> </b>

</pre></td></tr>
<tr>
<td><pre><font face="SunTommy">9. கல்லூரியில் சேர்க்கப்பட்ட தேதி மற்றும் சேர்க்கப்பட்ட வகுப்பு :
    (வருடத்திற்கு எழுத்தால் எழுதவும் )</font>
<font face="arial" size=2>    Date of admission and Class in which admitted
    (the year to be entered in words)</font></pre></td>
<td align=center  colspan="2"><?php $y3 = convertNumber($batch);

echo "<b>".strtoupper($doa)."<br>".strtoupper($y3)."<br>";?><center>
</td>
</tr>
<tr><td><pre>10. (அ). மாணவர் கல்லூரியை விட்டு நீங்கும் காலத்தில்
	  பயின்று வந்த வகுப்பு (எழுத்தால்):
<font face="arial" size=2>       (a).        Class in which the pupil was studying at the time of
                     leaving (in words)</font><br>
    (ஆ) தேர்ந்தெடுத்தப் பாடம் மற்றும் துணைப் படம்:
<font face="arial" size=2>        (b)   The course offered  Main and Ancillary </font><br><br>
   (இ) பகுதி 1-இல்  தேர்தெடுத்த மொழி: 
<font face="arial" size=2>       (c)   Language offered under Part-1</font><br><br><br><br>
   (ஈ) பயிற்று மொழி: 
<font face="arial" size=2>       (d)  Medium of Instruction</font>


</pre>
</td>
<td align=center  colspan="2"><pre>
<br>

<select name="sublevyear" id="sublevyear" required >
                                                <option>Select</option>
												<option>I</option>
												<option>II</option>
												<option>III</option>
</select> &nbsp;  <select name="dis" id="dis" required >
                                                <option>Select</option>
												<option>Completed</option>
												<option>Discontinued</option>
</select> <?php echo "<input type='text' size=20 name='sublev' value='$course'>";?>
<br><br><input type="text" size=30 class="form-control" name="aucsub">

<select name="part1" id="part1" required class="form-control">
                                                <option>Select</option>
												<option>Tamil</option>
                        <option>Vaniga Kadithangalum Aluvalaga Muraigalum</option>
												<option>English</option>
												<option>Other</option>
</select>
<input type='text' size=30 class='form-control' id="part1s" name='part1text' placeholder="Enter the Name of the Part1">

<select name="medium" id="mediums" required class="form-control">
                                                <option>Select</option>
												<option>Tamil</option>
												<option>English</option>
												</select>
</pre></td>
<tr><td>
<pre>11. கல்லூரிக்குச் செலுத்த வேண்டிய கட்டணத் தொகை 
    அனைத்தையும் மாணவர் செலுத்தி விட்டாரா?:
<font face="arial" size=2>       Whether the student has paid all the fees due to the college</font>

</pre></td>
<td align=center  colspan="2"><input type="radio" name="paid" value="Yes">Yes   <input type="radio" name="paid" value="No">No</td>
</tr>
<tr><td>
<pre>12. மாணவர் படிப்புதவித் தொகை அல்லது கல்வி சலுகை
    எதுவும் பெற்றவரா? (அதன் விவரத்தைக் குறிப்பிடுக):
<font face="arial" size=2>       Whether the student was in receipt of any scholarship (Nature of
	the Scholarship to be specified) or any Educational Concessions :       </font>
</pre></td> 
<td align=center  colspan="2"><br><input type="radio" name="scholar" id="scholaryes" value="Yes">Yes   <input type="radio" name="scholar" id="scholarno" value="No">No   <input type="text" size=30 Placeholder="Enter the Reason" class="form-control" id="scholars" name="scholartext"></td></tr>
<tr><td>
<pre>13.மாணவர் கல்வியாண்டில் மருத்துவ ஆய்வுக்குச்
   சென்றாரா? (முதல் தடவை அல்லது அதற்கு மேல் 
   குறிப்பிட்டு எழுதவும்):
<font face="arial" size=2>     Whether the student as undergone medical inspection if any 
     going the academic year (first or repeat to be specified) :              </font>
</pre></td> 
<td align=center  colspan="2"><br><input type="radio" name="medical" id="medicalyes" value="Yes">Yes   <input type="radio" name="medical" id="medicalno" value="No">No   <input type="text" size=30 Placeholder="Enter the Reason" class="form-control" id="medicals" name="medicaltext"></td></tr>
<tr><td><pre>
14. மாணவர் கல்லூரியைவிட்டு விலகிய நாள்: 
<font face="arial" size=2>       Date of which the student actually left to the college :  </font></pre></td>     
<td align=center  colspan="2"><br><div class="input-group input-append date" id="dp2" data-date=<?php echo date('d-m-Y');?> data-date-format="dd-mm-yyyy">
											<input type="number" name="doldate" placeholder="Date"  min="01" max="31"/>
											<input type="number" name="dolmonth" placeholder="Month"  min="01" max="12"/>
											<input type="number" name="dolyear" placeholder="Year" min="1990" max="2040"/>
											
								  </div></td></tr>
<tr><td><pre>15. மாணவரின் ஒழுக்கமும் பண்பும் :    
<font face="arial" size=2>     The student Conduct and Character :                      </font>
</pre></td> 
<td align=center  colspan="2"><br></tr>
<tr><td><pre><font face="SunTommy">16. பெற்றோர் அல்லது பாதுகாவலர் மாணவரின் மாற்றுச் 
      சான்றிதழ் கோரி விண்ணப்பித்த நாள்:
<font face="arial" size=2>     Date on which application for Transfer Certificate was made on
     behalf of the student by his parent or guardian :                    </font>
</pre></td> 
<td align=center  colspan="2"><br><div class="input-group input-append date" id="dp3" data-date=<?php echo date('d-m-Y');?> data-date-format="dd-mm-yyyy">
											<input type="number" name="applydate" placeholder="Date"  min="01" max="31"/>
											<input type="number" name="applymonth" placeholder="Month"  min="01" max="12"/>
											<input type="number" name="applyyear" placeholder="Year" min="1990" max="2040"/>
								  </div></td></tr>
<tr><td><pre>17.மாற்றுச் சான்றிதழின் நாள்:
<font face="arial" size=2>        Date of the Transfer Certificate :             </font>
</pre></td> 
<td align=center  colspan="2"><br><div class="input-group input-append date" id="dp4" data-date=<?php echo date('d-m-Y');?> data-date-format="dd-mm-yyyy">
											<input type="number" name="idatedate" placeholder="Date"  min="01" max="31"/>
											<input type="number" name="idatemonth" placeholder="Month"  min="01" max="12"/>
											<input type="number" name="idateyear" placeholder="Year" min="1990" max="2040"/>
								  </div></td></tr>
<tr><td><pre>18. படிப்புக் காலம்: 
<font face="arial" size=2>       Course of Study :             </font>
</pre></td> 
<td align=center  colspan="2"> <br><div class="col-lg-6"><input type="text" value="" size="30" min="1" max='5' class="form-control" name="noy" ></div>Year(s)</td></tr>

<table  border=1 align=center cellspacing=0 width=80%>
<tr align=center ><td><b>கல்லூரியின் பெயர் <br>
<font face="arial">Name of the College</font></b></td>
<td><b><font face="bamini">கல்வி ஆண்டுகள் </font><br>
<font face="arial">Academic Year</b></font></td>
<td><b><font face="bamini">படித்த வகுப்பு </font><br>
<font face="arial">Classes studied</font></b></td>
<td><b><font face="bamini">முதல் மொழி </font><br>
<font face="arial"><b>First language</font></b></td>
<td><b><font face="bamini">பயின்ற மொழி</font><br>
<font face="arial">Medium of Instruction</font></b></td>
</tr>
<tr align=center >
<td width=50% align=center><b>GOVT. ARTS COLLEGE<br>PARAMAKUDI-623701<br><br><b>Ramanathapuram</td>
<td>From:<input type="number" value="<?php echo $batch;?>" min="<?php echo $batch;?>" class="form-control" name="sdate">To:<input type="number" value="<?php echo $batch;?>" min="<?php echo $batch;?>" class="form-control" name="edate"></td>

<td><b><?php echo strtoupper($course);?></b></td>
<td><input type="text" readonly class="form-control" name="flang" id="flang"/></td>
<td><input type="text" readonly class="form-control" name="tmedium" id="tmedium"/></td>
</tr>
</table>
<br>
<tr><td colspan="3"><pre>19. கல்லூரி முதல்வரின் கையப்பம் 
   (நாள் மற்றும் கல்லூரி முத்திரையுடன் )
<font face="arial" size=2>     Signature of the Principle with date and with College Seal :               </font>
<br></td>
</tr>
</pre></tr> </table>
<pre>

குறிப்பு : (1) இச்சான்றிதழில் அழித்தல்கள் மற்றும் நம்பகமற்ற அல்லது மோசடியான திருத்தங்கள் செய்வது சான்றிதழை
             ரத்து செய்ய வழி வகுப்பதாகும். 
<font face="arial" size=2>   			Erasures and unauthenticated or fraudulent alterations in the certificate will lead to its cancellation.</font>
	    (2) கல்லூரி முதல்வரால் மையினால் கையெப்பமிட வேண்டும். பதிவு செய்யப்பட்ட விபரங்கள் 
		சரியானவை என்பதற்கு அவரே பொறுப்பானவர். 
<font face="arial" size=2> 			 Should be signed in ink by the Head of the Institution who will be held responsible for the correctness of the entries.</font>
	    (3) பெற்றோர் அல்லது பாதுகாவலர் அளிக்கும் உறுதி மொழி. 
<font face="arial" size=2> 			  Declaration by the Parent or guardian.</font><br><br>
     மேலே 2  முதல் 8 வரையுள்ள இனங்களுக்கெனப் பதிவு செய்யப்பட்டுள்ள விவரங்கள் சரியானவை என்றும். எதிர்காலத்தில் அவற்றில் மாற்றம் எதுவும் கேட்கமாட்டேன் என்றும் நான் உறுதியளிக்கின்றேன். 
<font face="arial" size=2> 	I hereby declare that the particulars recorded against items 2 to 8 are correct and that no change will be demanded by me in future.</font>
</pre>
<br><br><br>
<p align=right> பெற்றோர் அல்லது பாதுகாவலரின் கையொப்பம்.<br>
<font face="arial" size=2><p align=right> Signature of the Parent/Guardian.</font>


<br>
                                    
										
										
										                                   
                                    </tbody>
                                </table>
					<center><input type="submit" value="Issue" name="submit" class="btn btn-primary btn-lg " />
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
