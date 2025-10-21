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
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
     <!-- END HEAD -->
     <!-- BEGIN BODY -->
<body class="padTop53 " >

     <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
        <div id="top">

           <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="main1.php" class="navbar-brand">
                    <img src="assets/img/logo.PNG" alt="" />
                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <!-- MESSAGES SECTION -->
                    
                        

                    <!--END MESSAGES SECTION -->
 
                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="change.php"><i class="icon-gear"></i> Change Password </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-signout"></i> வெளியேறு  </a>
                            </li>
                        </ul>

                    </li>
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
       <div id="left">
            <div class="media user-media well-small">
                
                <br />
                <div class="media-body">
                    <h5 class="media-heading"> <br>Welcome  MR. <?php echo $_SESSION['login_user'];?></h5>
                    <ul class="list-unstyled user-info">
                        
                        
                    </ul>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">

                
                <li class="panel">
                    <a href="main1.php" >
                        <i class="icon-table"></i> முகப்பு 
	   
                       
                    </a>                   
                </li>
				
				<li class="panel">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav">
                        <i class="icon-pencil"></i> உறுப்புடி விபரம் 
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success">3</span>&nbsp;
                    </a>
                    <ul class="collapse" id="form-nav">
                        <li class=""><a href="mainstack.php"><i class="icon-angle-right"></i> இருப்பு நிலை  </a></li>
                        <li class=""><a href="varauvibaram.php"><i class="icon-angle-right"></i> வரவு விபரம் </a></li>
                        <li class=""><a href="virbanaivibaram1.php"><i class="icon-angle-right"></i> விற்பனை விபரம்   </a></li>
                    </ul>
                </li>
				
				<li class="active"><a href="user.php"><i class="icon-group"></i> கிளைண்ட்ஸ் விபரம்  </a></li>
				

                <li><a href="daybyday.php"><i class="icon-filter"></i> வடிகட்டுதல்  </a></li>
                <li><a href="logout.php"><i class="icon-signin"></i> வெளியேறு  </a></li>

            </ul>

        </div>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">

            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">


                        <h2> கிளைண்ட்ஸ் விபரம்  </h2>



                    </div>
                </div>

                <hr />


                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            கிளைண்ட்ஸ்
                        
                        <a class="btn btn-danger btn-sm btn-line" style="float:right!important;" data-toggle="collapse" data-target="#div2" href="adduser.php">சேர்</a>
                    
						</div>
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>வ. எண்.</th>
											<th>பெயர்</th>
                                            <th>எண் </th>
											<th>முகவரி</th>
                                            <th>திறக்கப்பட்ட தேதி </th>
                                            <th>செல்</th>
											
											<th>மற்றவை</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
										                                      
									   <?php
											$result = mysql_query("SELECT * FROM tex_cust");
												
												$sno=1;
												while($row = mysql_fetch_array($result)) 
											  {
											  $id=$row['id'];
											  echo "<tr class='odd'> ";
											  
											  echo "<td>".$sno."</td>";
											  echo "<td>".$row['name']."</td>";
											  echo "<td>".$row['cusno']."</td>";
											  echo "<td>".$row['address']."<br>".$row['mail']."</td>";
											  echo "<td class='center'>".$row['dob']."</td>";
											  echo "<td class='center'>".$row['cell']."</td>";
											  echo "<td class='center'>
											  
											  <div  class='btn-group'>
											  <button data-toggle='dropdown' class='btn btn-success dropdown-toggle'>Action <span class='caret'></span></button>
											  <ul class='dropdown-menu'>
												<li><a href='tex_useraccount.php?id=$id'>உறுப்புடி வரவு விபரம்</a></li>
												<li><a href='varau.php?id=$id'>உறுப்புடி வரவு</a></li>
												<!---<li><a href='delete.php?id=$id'>Delete</a></li>--->
											</ul>
											</div>
											  
											  </td>";
											  echo "</tr>";
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




        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   <!-- FOOTER -->
    <div id="footer">
        <p>&copy;  Maruthi Textile &nbsp; 2016-<?php echo date('Y');?> &nbsp;Developed by <B>High Reach Technique</b></p>
    </div>
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
</body>
     <!-- END BODY -->
</html>
<?php 
}
else {
header("Location:index.php");
}
?>