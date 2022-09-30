<?php
require_once 'connect.php';
session_start();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if ($_FILES["fileToUpload"]["size"] > 50000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  if ($imageFileType != "jpg") {
    print "Sorry, only JPGfiles are allowed.";
    $uploadOk = 0;
  }

  $image_info = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  $image_width = $image_info[0];
  $image_height = $image_info[1];

  if ($image_height > 200){

        print "image height > 200";
        $uploadOk = 0;
  }
  
  if ($image_width > 200){
    print "image width > 200";
    $uploadOk = 0;
}

  if ($uploadOk == 0) {
    print "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      $stmt = $conn->prepare("INSERT INTO submission_detail (userid, path)
              VALUES (:userid, :path)");
    $stmt->execute(array(':userid' => $_SESSION['id'], ':path' => $target_file));
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
?>