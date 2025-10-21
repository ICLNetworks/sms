<?php
echo "WELCOME";
echo $_POST['fileToUpload'];
echo $_FILES['fileToUpload'];
$target_dir = "uploads/";
$fileToUpload=$_POST['fileToUpload'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$target_file=$target_dir.$fileToUpload;
echo $target_file;
$uploadOk = 1;
/*$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_POST["fileToUpload"]["tmp_name"]);
	// Check if file already exists
if (file_exists($target_file)) {
    $error=$error+"Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2097152) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error*/
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


    if($check !== false) {
$img=$_FILES["fileToUpload"]["name"];
echo $img;

    } else {
        echo "Car is not Added.";
        $uploadOk = 0;
    }
?>
<html>
<form class="edit-profile-form"  enctype="multipart/form-data" action="" name="form1" method="post" onSubmit="return check();">
select
<input type="file" name="fil" id="fil">
<input type="submit">
</form>
</html>
