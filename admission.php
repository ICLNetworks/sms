<?php
@ob_start();
@session_start();
if (!isset($_SESSION['login_user'])) {
    header("Location: index.php");
    exit();
}

include("includes/db.conn.php");

$editMode = false;
$editId = null;
$formData = [
    'adno' => '',
    'ayear' => '',
    'emisno' => '',
    'std' => '',
    'admission_date' => '',
    'name' => '',
    'name1' => '',
    'fname' => '',
    'fname1' => '',
    'mname' => '',
    'mname1' => '',
    'gender' => '',
    'dob' => '',
    'national' => '',
    'religion' => '',
    'comm' => '',
    'subc' => '',
    'dist' => '',
    'pschool' => '',
    'van' => '',
    'bg' => '',
    'occ' => '',
    'income' => '',
    'address' => '',
    'mob' => '',
    'mark' => '',
    'tags' => '',
    'tags1' => '',
    'photo' => '',
];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $editMode = true;
    $editId = (int)$_GET['id'];

    $res = mysqli_query($conn, "SELECT * FROM register WHERE id='$editId'");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $formData['adno'] = $row['adno'];
        $formData['ayear'] = $row['ayear'];
        $formData['emisno'] = $row['emisno'];
        $formData['std'] = $row['std'];
        $formData['admission_date'] = $row['doa'];
        $formData['name'] = $row['name'];
        $formData['name1'] = $row['name1'];
        $formData['fname'] = $row['fname'];
        $formData['fname1'] = $row['fname1'];
        $formData['mname'] = $row['mname'];
        $formData['mname1'] = $row['mname1'];
        $formData['gender'] = $row['gender'];
        $formData['dob'] = $row['dob'];
        $formData['national'] = $row['national'];
        $formData['religion'] = $row['religion'];
        $formData['comm'] = $row['comm'];
        $formData['subc'] = $row['subc'];
        $formData['dist'] = $row['dist'];
        $formData['pschool'] = $row['pschool'];
        $formData['van'] = $row['van'];
        $formData['bg'] = $row['bg'];
        $formData['occ'] = $row['occ'];
        $formData['income'] = $row['income'];
        $formData['address'] = $row['address'];
        $formData['mob'] = $row['mobileno'];
        $formData['tags'] = $row['tags'];
        $formData['photo'] = $row['photo'];
    }
}

if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
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
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

?>

    <script>
        window.location = 'adminview.php';
    </script>
<?php



}


?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->

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
        function devPrint() {
            window.print();
        }


        function check() {
            if (document.form1.course.value == "Select" || document.form1.course.value == "") {
                alert("Please choose the course");
                document.form1.course.focus();
                return false;
            }

            if (document.form1.shift.value == "Select") {
                alert("Please choose the Shift");
                document.form1.shift.focus();
                return false;
            }
            if (document.form1.addate.value == "") {
                alert("Please enter the ADMISSION Date");
                document.form1.addate.focus();
                return false;
            }
            if (document.form1.admonth.value == "") {
                alert("Please enter the ADMISSION Month");
                document.form1.admonth.focus();
                return false;
            }
            if (document.form1.adyear.value == "") {
                alert("Please enter the ADMISSION Year");
                document.form1.adyear.focus();
                return false;
            }
            if (document.form1.adno.value == "") {
                alert("Please enter the ADMISSION NUMBER");
                document.form1.adno.focus();
                return false;
            }
            if (document.form1.emicno.value == "") {
                alert("Please enter the EMIC NUMBER");
                document.form1.emicno.focus();
                return false;
            }


            if (document.form1.name.value == "") {
                alert("Please Enter the Name");
                document.form1.name.focus();
                return false;
            }
            if (document.form1.name1.value == "") {
                alert("Please Enter the Name in Tamil");
                document.form1.name1.focus();
                return false;
            }
            if (document.form1.name.value.length == 1) {
                alert("You must enter the full name");
                document.form1.name.focus();
                return false;
            }


            if (document.form1.sex.value == "") {
                alert("Please choose the sex");
                return false;
            }

            if (document.form1.dobdate.value.length == "") {
                alert("You must enter the date of the DATE of Birth");
                document.form1.dobdate.focus();
                return false;
            }

            if (document.form1.dobmonth.value.length == "") {
                alert("You must enter the Month of the DATE of Birth");
                document.form1.dobmonth.focus();
                return false;
            }
            if (document.form1.dobyear.value.length == "") {
                alert("You must enter the Year of the DATE of Birth");
                document.form1.dobyear.focus();
                return false;
            }

            if (document.form1.national.value == "") {
                alert("Plese enter the nationality");
                document.form1.national.focus();
                return false;
            }

            if (document.form1.religion.value == "Select") {
                alert("Plese enter the RELIGION");
                document.form1.religion.focus();
                return false;
            }
            if (document.form1.religion.value == "Others") {
                alert("Plese enter the Reason of RELIGION");
                document.form1.religiontext.focus();
                return false;
            }

            if (document.form1.comm.value == "Select") {
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
            if (document.form1.pschool.value == "") {
                alert("Plese enter the previous school name");
                document.form1.pschool.focus();
                return false;
            }

            if (document.form1.dist.value == "Select") {
                alert("Plese enter the DISTRICT NAME");
                document.form1.dist.focus();
                return false;
            }
            if (document.form1.fm.value == "") {
                alert("Plese enter the Father/Mother/Guardian NAME");
                document.form1.fm.focus();
                return false;
            }
            if (document.form1.fm1.value == "") {
                alert("Plese enter the Father/Mother/Guardian NAME in Tamil");
                document.form1.fm1.focus();
                return false;
            }
            if (document.form1.tho.value == "") {
                alert("Plese enter the No.11");
                return false;
            }
            if (document.form1.income.value == "") {
                alert("Plese enter the ANNUAL INCOME");
                document.form1.income.focus();
                return false;
            }
            if (document.form1.handi.value == "") {
                alert("Plese choose the No.13");
                return false;
            }
            if (document.form1.exser.value == "") {
                alert("Plese choose the No.14");
                return false;
            }
            if (document.form1.orgin.value == "") {
                alert("Plese choose the No.15");
                return false;
            }
            if (document.form1.sports.value == "") {
                alert("Plese choose the No.16");
                return false;
            }
            if (document.form1.addr.value == "") {
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



            /*if(document.form1.fileToUpload.value=="")
{
alert("Plese choose the Picture");
document.form1.fileToUpload.focus();
return false;
}*/

            return true;
        }
    </script>
    <link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script>
        $(function() {
            var bc = ["Select", "Sourashtra", "Pattunulkarar"];
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
                if ($("#religion").val() == 'Others') {
                    //alert(temp);
                    $('#religions').show()
                } else {
                    $('#religions').hide()
                }

            });

            $('#dist').change(function() {
                var temp = $("#dist").val();
                if ($("#dist").val() == 'Others') {
                    //alert(temp);
                    $('#dists').show()
                } else {
                    $('#dists').hide()
                }

            });

            // // cUT THE MATTERS 			

            // $('#markeng').click(function () {
            //     $('#markenglish').show();
            //     $('#marktamil').hide();

            // });
            // $('#marktm').click(function () {
            //     $('#markenglish').hide();
            //     $('#marktamil').show();

            // });

        });


        $(document).ready(function() {});
    </script>

    <style>
        #sitehtn,
        #handis,
        #exsers,
        #orgins,
        #sportss,
        #religions,
        #dists,
        #comms,
        #subcs {
            display: none
        }

        .van-btn {
            width: 60px;
            height: 30px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
            border-color: green;
        }

        .van-btn:hover {
            background-color: green;
            color: white;
        }
    </style>
    <script>
        function toggleVan(show) {
            document.getElementById("VanRow").style.display = show ? "table-row" : "none";
            if (!show) {
                document.getElementById('vanRowSelect').selectedIndex = 0;
            }

        }

        function togglePnd(show) {
            document.getElementById("pendingFee").style.display = show ? "table-row" : "none";
            if (!show) {
                $('#pndscl').val('');
                $('#pndvan').val('');
            }

        }
        // setTimeout(function() {
        //     location.reload();
        // }, 1000); // refresh every 5 seconds
    </script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body>
    <!--MAIN CONTAINER -->

    <?php include("header.php"); ?>

    <div id="main">

        <!-- PAGE CONTENT -->
        <div class="container">

            <div class="clearfix">

            </div>
            <div id="counter"></div>


            <div id="counter-default" class="row">
                <form id="block-validate" action="postadmission.php" enctype="multipart/form-data" name="form1"
                    method="post" onSubmit="return check();">
                    <?php if ($editMode): ?>
                        <input type="hidden" name="update" value="1">
                        <input type="hidden" name="id" value="<?php echo $editId; ?>">
                        <input type="hidden" name="existing_photo" value="<?php echo htmlspecialchars($formData['photo']); ?>">
                    <?php endif; ?>
                    <div class="row">

                        <div class="col-lg-12">
                            <center>
                                <h3><b>ADMISSION REGISTERATION</b> </h3>
                            </center>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <B>Basic Details<B>
                                            <a class="btn btn-danger btn-sm btn-line" style="float:right!important;"
                                                href="logout.php">Logout</a>

                                            <a class="btn btn-danger btn-sm btn-line" style="float:right!important;"
                                                href="home.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <tbody>
                                                <tr>
                                                    <td><label class="control-label">Admission Number</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="adno"
                                                                    id="adno" required value="<?php echo htmlspecialchars($formData['adno']); ?>" <?php echo $editMode ? 'readonly' : ''; ?>>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Admission Year</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="ayear"
                                                                    id="ayear" required>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">EMIS Number</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="emisno"
                                                                    id="emisno" required>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td><label class="control-label">Admission Standard</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-6">
                                                                <select name="std" id="std" class="form-control" required>
                                                                    <option value="">Select</option>
                                                                    <option value="LKG">LKG</option>
                                                                    <option value="UKG">UKG</option>
                                                                    <option value="I Std">I Std</option>
                                                                    <option value="II Std">II Std</option>
                                                                    <option value="III Std">III Std</option>
                                                                    <option value="IV Std">IV Std</option>
                                                                    <option value="V Std">V Std</option>
                                                                    <option value="VI Std">VI Std</option>
                                                                    <option value="VII Std">VII Std</option>
                                                                    <option value="VIII Std">VIII Std</option>
                                                                    <option value="IX Std">IX Std</option>
                                                                    <option value="X Std">X Std</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">DATE OF ADMISSION</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-6">
                                                                <input type="Date" name="admission_date"
                                                                    class="form-control" placeholder="Admission Date"
                                                                    min="01" max="31" required />
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
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <tbody>
                                                <tr>
                                                    <td><label class="control-label">NAME</label>
                                                        <br><br>
                                                        <label for="" class="control-label"
                                                            style="font-family: Bamini;"> &nbsp; &nbsp; (khzt (m)
                                                            khztpaH ngaH jkpopy;)</label>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="name"
                                                                    id="name" required>
                                                                <br>
                                                                <div id="marktamil1" style="font-family: Bamini;">
                                                                    <input type="text" name="name1" value=""
                                                                        class="form-control"
                                                                        placeholder="ngau; jkpopy;" required />
                                                                </div>
                                                            </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="" class="control-label">Father's Name</label>
                                                        <br><br>
                                                        <label for="" class="control-label"
                                                            style="font-family: Bamini;"> &nbsp; &nbsp; (je;ijapd; ngaH
                                                            jkpopy;)</label>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="fname"
                                                                    id="fname" required>
                                                                <BR>
                                                                <div id="marktamil1" style="font-family: Bamini;">
                                                                    <input type="text" name="fname1" value=""
                                                                        class="form-control"
                                                                        placeholder="ngau; jkpopy;" required />
                                                                </div>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="" class="control-label">Mother's Name</label>
                                                        <br><br>
                                                        <label for="" class="control-label"
                                                            style="font-family: Bamini;"> &nbsp; &nbsp; (jhapd; ngaH
                                                            jkpopy;)</label> 
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control" name="mname"
                                                                    id="mname" required>
                                                                <BR>
                                                                <div id="marktamil1" style="font-family: Bamini;">
                                                                    <input type="text" name="mname1" value=""
                                                                        class="form-control"
                                                                        placeholder="ngau; jkpopy;" required />
                                                                </div>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Gender</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="radio" name="gender" id="gender"
                                                                    value="Male" required />Male&nbsp;&nbsp;
                                                                <input type="radio" name="gender" id="gender"
                                                                    value="Female" />Female&nbsp;&nbsp;
                                                                <input type="radio" name="gender" id="gender"
                                                                    value="Transgender" />Transgender
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label"> DATE OF BIRTH</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input class="form-control" type="Date" name="dob"
                                                                    min="01" max="31" required />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">NATIONALITY</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="text" class=" form-control" name="national"
                                                                    value="Indian" id="national" required>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>


                                                <tr>
                                                    <td><label class="control-label">RELIGION</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <select name="religion" id="religion"
                                                                    class="form-control" required>
                                                                    <option value="">Select</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Muslim">Muslim</option>
                                                                    <option value="Christian">Christian</option>
                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <br>
                                                                <input placeholder="Enter the Reason " type="text"
                                                                    class=" form-control" name="religiontext"
                                                                    id="religions" />


                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td><label class="control-label">COMMUNITY</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <select name="comm" id="comm" class="form-control" required>
                                                                    <option value="">Select</option>
                                                                    <option value="BC">BC</option>
                                                                    <option value="BC Muslim">BC Muslim</option>
                                                                    <option value="MBC/DNC">MBC/DNC</option>
                                                                    <option value="SC">SC</option>
                                                                    <option value="ST">ST</option>

                                                                    <option value="Others">Others</option>
                                                                </select>
                                                                <br>
                                                                <input placeholder="Enter the Community Name "
                                                                    type="text" class="form-control" name="commtext"
                                                                    id="comms" />
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td><label class="control-label">SUB CASTE</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <select name="subc" id="subc" class="form-control"
                                                                    onchange="toggleOtherInput()" required>
                                                                    <option value="">-- Select --</option>
                                                                    <option value="Sourashtra">Sourashtra</option>
                                                                    <option value="Others">Others</option>
                                                                </select>

                                                                <!-- Hidden input box -->
                                                                <input type="text" name="subcr" id="subc_other"
                                                                    class="form-control mt-2"
                                                                    placeholder="Enter Sub Caste" style="display:none;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label"> DISTRICT</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <select name="dist" id="dist" class="form-control" required>
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
                                                                <input placeholder="Enter the District " type="text"
                                                                    class=" form-control" name="disttext" id="dists" />


                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>


                                                <tr>
                                                    <td><label class="control-label">Last Stuied School Name</label>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <input type="text" class=" form-control" name="pschool"
                                                                    id="pschool" required>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Student have any pending amount?</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <button type="button" class="van-btn"
                                                                    onclick="togglePnd(true)">Yes</button>
                                                                <button type="button" class="van-btn" name="pnd"
                                                                    onclick="togglePnd(false)">No</button>
                                                            </div>
                                                            <div class="form-group" id="pendingFee" style="display: none">
                                                                <br>
                                                                <div class="col-lg-12" style="display: flex;gap: 2vw;">
                                                                    <input type="number" class=" form-control" name="pndscl"
                                                                        id="pndscl" placeholder="Pending school fee">
                                                                    <input type="number" class=" form-control" name="pndvan"
                                                                        id="pndvan" placeholder="Pending van fee">
                                                                </div>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Student's Van Facilities</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <button type="button" class="van-btn"
                                                                    onclick="toggleVan(true)">Yes</button>
                                                                <button type="button" class="van-btn" name="van"
                                                                    onclick="toggleVan(false)">No</button>
                                                            </div>
                                                            <div class="form-group" id="VanRow" style="display: none">
                                                                <br>
                                                                <div class="col-lg-12">
                                                                    <?php
                                                                    $sql = "SELECT DISTINCT city FROM vanfeedetails ORDER BY city ASC";
                                                                    $result = mysqli_query($conn, $sql);
                                                                    ?>
                                                                    <select name="van" class="form-control" id="vanRowSelect">
                                                                        <option value="">-- Select City --</option>
                                                                        <?php
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            echo "<option value='" . htmlspecialchars($row['city']) . "'>" . htmlspecialchars($row['city']) . "</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Blood Group</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <input type="text" name="bg" id="bg" value=""
                                                                    class="form-control" placeholder="Ex. O+ve" required /><br>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td><label class="control-label">13. Parent Occupation</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <input type="text" name="occ" value=""
                                                                    class="form-control" placeholder="Ex. Weaver" /><br>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">14. Parent Annual Income</label>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <input type="text" name="income" value=""
                                                                    class="form-control" placeholder="Ex. 75000" /><br>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <td><label class="control-label">Address</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <textarea name="address" id="" rows="6"
                                                                    cols="60" required></textarea>
                                                                <!-- <input type="textarea" name="address" value="" class="form-control" /><br> -->
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Moblie No</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <input type="text" name="mob" value=""
                                                                    class="form-control" required />
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Personal Mark on
                                                            Indentification</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <!-- <input type="radio" name="mark" id="markeng" value="eng">English &nbsp; 
                                                            <input type="radio" id="marktm" name="mark" value="tam">தமிழ் -->
                                                            <div class="col-lg-8" id="markenglish">
                                                                <input type="text" name="tags" value=""
                                                                    class="form-control"
                                                                    placeholder="Enter the 1st Indentification" required /><br>
                                                                <input type="text" name="tags1" value=""
                                                                    class="form-control"
                                                                    placeholder="Enter the 2nd Indentification" required />
                                                            </div>
                                                            <!-- <div class="col-lg-8" id="marktamil"
                                                                style="font-family: Bamini;">
                                                                <input type="text" name="tagst" value=""
                                                                    class="form-control"
                                                                    placeholder="Kjy; milahsk;" /><br>
                                                                <input type="text" name="tags1t" value=""
                                                                    class="form-control"
                                                                    placeholder=",uz;lhtJ milahsk;" />
                                                            </div> -->
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Photo</label></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="col-lg-8">
                                                                <div class="fileupload fileupload-new"
                                                                    data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail"
                                                                        style="width: 200px; height: 150px;"><img
                                                                            src="assets/img/demoUpload.jpg" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail"
                                                                        style="max-width: 200px; max-height: 150px; line-height: 20px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-file btn-primary"><span
                                                                                class="fileupload-new">Select
                                                                                image</span><span
                                                                                class="fileupload-exists">Change</span><input
                                                                                type="file" name="fileToUpload"
                                                                                id="fileToUpload" <?php echo $editMode ? '' : 'required'; ?> /></span>
                                                                        <?php if ($editMode && !empty($formData['photo'])): ?>
                                                                            <div style="margin-top: 10px;">
                                                                                <strong>Current photo:</strong><br>
                                                                                <img src="<?php echo htmlspecialchars($formData['photo']); ?>" style="max-width: 150px; max-height: 150px;" />
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <a href="#"
                                                                            class="btn btn-danger fileupload-exists"
                                                                            data-dismiss="fileupload">Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <center>
                                            <?php if ($editMode): ?>
                                                <input type="submit" value="Update" name="update" class="btn btn-primary btn-lg" />
                                            <?php else: ?>
                                                <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-lg" />
                                                <input type="reset" class="btn btn-success btn-lg btn-grad" />
                                            <?php endif; ?>
                                            <br><a href="home.php" class="btn btn-info btn-lg btn-grad">Back</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php if ($editMode): ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const admissionData = <?php echo json_encode($formData); ?>;
                            for (const [key, value] of Object.entries(admissionData)) {
                                const el = document.querySelector('[name="' + key + '"]');
                                if (!el) continue;
                                if (el.type === 'radio' || el.type === 'checkbox') {
                                    const match = document.querySelector('[name="' + key + '"][value="' + value + '"]');
                                    if (match) match.checked = true;
                                } else {
                                    el.value = value;
                                }
                            }
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
        <!--END PAGE CONTENT -->
    </div>
    <!--END MAIN CONTAINER -->

    <script>
        function toggleOtherInput() {
            var subc = document.getElementById("subc").value;
            var otherInput = document.getElementById("subc_other");
            if (subc === "Others") {
                otherInput.style.display = "block";
            } else {
                otherInput.style.display = "none";
                otherInput.value = ""; // clear if not used
            }
        }
    </script>
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
        $(function() {
            formInit();
        });
    </script>

</body>
<!-- END BODY -->

</html>
<?php

?>