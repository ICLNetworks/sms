<?php

include("includes/db.conn.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $adno = $_POST['adno'];
    $ayear = $_POST['ayear'];
    $emisno = $_POST['emisno'];
    $std = $_POST['std'];

    $doa = $_POST['admission_date'];

    $name = $_POST['name'];
    $name1 = $_POST['name1'];
    $fname = $_POST['fname'];
    $fname1 = $_POST['fname1'];
    $mname = $_POST['mname'];
    $mname1 = $_POST['mname1'];

    $gender = $_POST['gender'];

    $dob = $_POST['dob'];

    $comm = $_POST['comm'];
    $subc = $_POST['subc'];

    $pschool = $_POST['pschool'];
    $national = $_POST['national'];
    $religion1 = $_POST['religion'];
    if ($religion1 == "Others") {
        $religiontext = $_POST['religiontext'];
        $religion = $religion1 . " &nbsp;&nbsp;&nbsp;&nbsp;" . $religiontext;
    } else {
        $religion = $religion1;
    }

    $pndscl = $_POST['pndscl'];
    $pndvan = $_POST['pndvan'];
    $van = $_POST['van'];
    $bg = $_POST['bg'];
    $occ = $_POST['occ'];
    $income = $_POST['income'];

    $address = $_POST['address'];
    $mobileno = $_POST['mob'];

    // $mark = $_POST['mark'];
    // if ($mark == "eng") {
        $tags11 = $_POST['tags'];
        $tags1 = $_POST['tags1'];
    // } else {
    //     $tags11 = $_POST['tagst'];
    //     $tags1 = $_POST['tags1t'];
    // }

    $tags = "1. " . $tags11 . "& 2." . $tags1;

    $dist1 = $_POST['dist'];
    if ($dist1 == "Others") {
        $disttext = $_POST['disttext'];
        $dist = $disttext;
    } else {
        $dist = $dist1;
    }

    $target_file = $_POST['existing_photo'] ?? '';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
    }

    $query = "UPDATE register SET adno='$adno', ayear='$ayear', emisno='$emisno', std='$std', doa='$doa', name='$name', name1='$name1', fname='$fname', fname1='$fname1', mname='$mname', mname1='$mname1', gender='$gender', dob='$dob', comm='$comm', subc='$subc', pschool='$pschool', national='$national', religion='$religion', dist='$dist', van='$van', bg='$bg', occ='$occ', income='$income', address='$address', mobileno='$mobileno', tags='$tags', photo='$target_file' WHERE id='$id'";
    mysqli_query($conn, $query);

    // Update dependent tables
    $res = mysqli_query($conn, "SELECT * FROM sclfeedetails where standard='$std'");
    $totalfee = 0;
    while ($row = mysqli_fetch_array($res)) {
        if ($subc === 'Sourashtra') {
            $totalfee = $row['discount_fee'];
        } else {
            $totalfee = $row['total_fee'];
        }
    }

    $vanfee = 0;
    $res = mysqli_query($conn, "SELECT * FROM vanfeedetails where city='$van'");
    while ($row = mysqli_fetch_array($res)) {
        $vanfee = $row['amount'];
    }

    mysqli_query($conn, "UPDATE stu_basic_info SET student_name='$name', father_name='$fname', mother_name='$mname', emis_number='$emisno', standard='$std', full_school_fee='$totalfee', pending_school_fee='$totalfee', full_van_fee='$vanfee', pending_van_fee='$vanfee', last_year_pending_scl='$pndscl', last_year_pending_van='$pndvan', photo='$target_file' WHERE admission_id='$adno'");

    mysqli_query($conn, "UPDATE student_fees SET pending_amount='$totalfee', paid_date='$doa' WHERE admission_id='$adno' AND fee_type='Study'");
    mysqli_query($conn, "UPDATE student_fees SET pending_amount='$vanfee', paid_date='$doa' WHERE admission_id='$adno' AND fee_type='Van'");

    header("Location: adminview.php");
    exit();
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


    echo "Welcome....";
    $adno = $_POST['adno'];
    $ayear = $_POST['ayear'];
    $emisno = $_POST['emisno'];
    $std = $_POST['std'];

    $doa = $_POST['admission_date'];


    $name = $_POST['name'];
    $name1 = $_POST['name1'];
    $fname = $_POST['fname'];
    $fname1 = $_POST['fname1'];
    $mname = $_POST['mname'];
    $mname1 = $_POST['mname1'];


    $gender = $_POST['gender'];


    $dob = $_POST['dob'];

    $comm = $_POST['comm'];
    $subc = $_POST['subc'];


    $pschool = $_POST['pschool'];
    $national = $_POST['national'];
    $religion1 = $_POST['religion'];
    if ($religion1 == "Others") {
        $religiontext = $_POST['religiontext'];
        $religion = $religion1 . " &nbsp;&nbsp;&nbsp;&nbsp;" . $religiontext;
    } else {
        $religion = $religion1;
    }

    $pndscl = $_POST['pndscl'];
    $pndvan = $_POST['pndvan'];
    $van = $_POST['van'];
    $bg = $_POST['bg'];
    $occ = $_POST['occ'];
    $income = $_POST['income'];



    $address = $_POST['address'];
    $mobileno = $_POST['mob'];


    $mark = $_POST['mark'];
    echo $mark;
    if ($mark == "eng") {
        $tags11 = $_POST['tags'];
        $tags1 = $_POST['tags1'];
    } else {
        $tags11 = $_POST['tagst'];
        $tags1 = $_POST['tags1t'];
    }


    $tags = "1. " . $tags11 . "& 2." . $tags1;

    $dist1 = $_POST['dist'];
    if ($dist1 == "Others") {
        $disttext = $_POST['disttext'];
        $dist = $disttext;
    } else {
        $dist = $dist1;
    }


    $status = "Fees Not Paid";
    $res = mysqli_query($conn, "SELECT * FROM sclfeedetails where standard='$std'");

    $totalfee = 0;
    while ($row = mysqli_fetch_array($res)) {
        if ($subc === 'Sourashtra') {
            $totalfee = $row['discount_fee'];
        } else {
            $totalfee = $row['total_fee'];
        }
    }

    $vanfee = 0;
    $res = mysqli_query($conn, "SELECT * FROM vanfeedetails where city='$van'");
    while ($row = mysqli_fetch_array($res)) {
        $vanfee = $row['amount'];
    }

    // $query1 = "insert into register(adno,ayear,emisno,std,doa,name,name1,fname,fname1,mname,mname1,gender,dob,comm,subc,pschool,national,religion,dist,van,bg,occ,income,address,mobileno,tags,photo,status) values('$adno','$ayear','$emisno','$std','$doa','$name','$name1','$fname','$fname1','$mname','$mname1','$gender','$dob','$comm','$subc','$pschool','$national','$religion','$dist','$van','$bg','$occ','$income','$address','$mobileno','$tags','$target_file','$status')";
    // $result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));


    // $query2 = "insert into stu_basic_info(admission_id, student_name, father_name,mother_name,emis_number,standard,full_school_fee,pending_school_fee,full_van_fee,pending_van_fee,last_year_pending_scl,last_year_pending_van,photo) values('$adno','$name','$fname','$mname', '$emisno','$std','$totalfee','$totalfee','$vanfee' ,'$vanfee' ,'$pndscl', '$pndvan', '$target_file')";
    // $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

    // $totalfee = (int)$totalfee + (int)$pndscl;
    // $query3 = $query3 = "INSERT INTO student_fees(admission_id, fee_type, pending_amount, paid_date) VALUES ('$adno','Study','$totalfee','$doa')";
    // $result3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));

    // $vanfee = (int)$vanfee + (int)$pndvan;
    // $query4 = "insert into student_fees(admission_id, fee_type, pending_amount, paid_date) values('$adno','Van', '$vanfee', '$doa')";
    // $result4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));


    try {
        // Start transaction
        mysqli_begin_transaction($conn);
    
        // Example variables (ensure these are assigned from POST or other source)
        // $adno, $ayear, $emisno, $std, $doa, $name, $name1, $fname, etc.
        // $totalfee, $pndscl, $vanfee, $pndvan, $target_file, $status etc.
    
        // 1️⃣ Register Table
        $query1 = "insert into register(adno,ayear,emisno,std,doa,name,name1,fname,fname1,mname,mname1,gender,dob,comm,subc,pschool,national,religion,dist,van,bg,occ,income,address,mobileno,tags,photo,status) values('$adno','$ayear','$emisno','$std','$doa','$name','$name1','$fname','$fname1','$mname','$mname1','$gender','$dob','$comm','$subc','$pschool','$national','$religion','$dist','$van','$bg','$occ','$income','$address','$mobileno','$tags','$target_file','$status')";
        if (!mysqli_query($conn, $query1)) {
            throw new Exception("Failed to insert into register table: " . mysqli_error($conn));
        }
    
        // 2️⃣ stu_basic_info Table
        $query2 = "insert into stu_basic_info(admission_id, student_name, father_name,mother_name,emis_number,standard,full_school_fee,pending_school_fee,full_van_fee,pending_van_fee,last_year_pending_scl,last_year_pending_van,photo) values('$adno','$name','$fname','$mname', '$emisno','$std','$totalfee','$totalfee','$vanfee' ,'$vanfee' ,'$pndscl', '$pndvan', '$target_file')";
        if (!mysqli_query($conn, $query2)) {
            throw new Exception("Failed to insert into stu_basic_info table: " . mysqli_error($conn));
        }
    
        // 3️⃣ student_fees — Study
        $totalfee = (int)$totalfee + (int)$pndscl;
        $query3 = $query3 = "INSERT INTO student_fees(admission_id, fee_type, pending_amount, paid_date) VALUES ('$adno','Study','$totalfee','$doa')";
        if (!mysqli_query($conn, $query3)) {
            throw new Exception("Failed to insert Study fees: " . mysqli_error($conn));
        }
    
        // 4️⃣ student_fees — Van
        $vanfee = (int)$vanfee + (int)$pndvan;
        $query4 = "insert into student_fees(admission_id, fee_type, pending_amount, paid_date) values('$adno','Van', '$vanfee', '$doa')";
        if (!mysqli_query($conn, $query4)) {
            throw new Exception("Failed to insert Van fees: " . mysqli_error($conn));
        }
    
        // ✅ If all queries succeed, commit the transaction
        mysqli_commit($conn);
    
    } catch (Exception $e) {
        // ❌ Rollback on error
        mysqli_rollback($conn);
    
        // Store error details in session
        $_SESSION['error_code'] = "500";
        $_SESSION['error_message']  = $e.getMessage();
        $_SESSION['error_msg']  = "Exception - " . $e;
    
        // Redirect to your new styled error page
        header("Location: error.php");
        exit();
    }
    
}
?>
<script>
    window.location = 'adminview.php';
</script>
<?



?>
