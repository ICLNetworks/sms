<html>
	<head>	
		<title>VIEW~admin</title>
		<link href="..\css\style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='//fonts.googleapis.com/css?family=Lobster|Pacifico:400,700,300|Roboto:400,100,100italic,300,300italic,400italic,500italic,500' ' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Raleway:400,100,500,600,700,300' rel='stylesheet' type='text/css'>
		<!--webfonts-->
	<script type="text/javascript">

	function devPrint()
	{
	window.print();
	}
	</script>
	</head>
	<body>	
			<!--start-login-form-->
				<div class="main">
			    	<div class="login-head">
					    <h1>About Call CENTER Data Base</h1>
					</div>
					<div  class="wrap">
						<div class="Regisration" style="background:white!important; width:90%!important;">
						  	
				<br><center><h1>OFFICE Details</h1><table width="100%" border="2px solid balck">
					
							<b><tr>
								<th>S.No</th>
								<th>Channel Name</th>
								<th>Username</th>
							</b></tr>
						
<form method="Post"> 
<?php 
$conn = mysql_connect("localhost", "sunbusin_enquiry", "simmedia123!@#");
$db = mysql_select_db("sunbusin_enquiry", $conn);
$result = mysql_query("SELECT * FROM enquiry"); 	
$i=1;
while($row = mysql_fetch_array($result)) 
  { 
   
  echo "<tr align='center'>" ; 
  echo "<td>". $i ."</td>"; 
  echo "<td style='color:Blue;'>" . $row['username'] . "</td>"; 
  echo "<td>". $row['password'] . "</td>"; 
   echo "</tr>"; 
  echo "<input type=hidden name='i' value='".$i."'>";  
	$i++;
  } 
echo "</table></center>"; 

mysql_close($conn); 
?>	
</form>


<center><h1>Admin Details</h1><table width="100%" border="2px solid balck">
					
							<b><tr>
								<th>S.No</th>
								<th>Username</th>
								<th>Password</th>
							</b></tr>
						
<form method="Post"> 
<?php 
$conn = mysql_connect("localhost", "sunbusin_enquiry", "simmedia123!@#");
$db = mysql_select_db("sunbusin_enquiry", $conn);
$result = mysql_query("SELECT * FROM admin"); 	
$i=1;
while($row = mysql_fetch_array($result)) 
  { 
   
  echo "<tr align='center'>" ; 
  echo "<td>". $i ."</td>"; 
  echo "<td style='color:Blue;'>" . $row['username'] . "</td>"; 
  echo "<td>". $row['password'] . "</td>"; 
  echo "</tr>"; 
  $i++;
  } 
echo "</table></center>"; 

mysql_close($conn); 
?>	
</form>




					
					<a href="#" onclick="devPrint()"><img src="..\images\print.jpg" style="width:50px; height:50px;float:right;"></a>					
		

		
							 
						  	</div>
					</div>
				<!--//End-login-form-->	
						<div class ="copy-right">
							<p> &copy; 2016 SiM. All rights reserved | Develped by Sun Info Media</p>
						</div>
			  </div>
		  
	</body>
</html>

