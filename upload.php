<?php 
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 include  "config.php";
 $firstname=$error="";
 if (isset($_GET['email'])) {
    $email = $_GET['email'];

     $sql = "SELECT * FROM  form WHERE email='$email'";

 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 $firstname= $row['firstname'];
 $lastname=  $row['lastname'];
 $address = $row['address'];
 $subject = $row['subject'];
 $gender = $row['gender'];

 $target_dir = "uploads/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
 // Check if image file is a actual image or fake image
 if(isset($_POST["submit"])) {
   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   if($check !== false) {
     $error= "File is an image - " . $check["mime"] . ".";
     $uploadOk = 1;
   } else {
    $error= "File is not an image.";
     $uploadOk = 0;
   }
 }
 
 // Check if file already exists
 if (file_exists($target_file)) {
  $error= "Sorry, file already exists.";
   $uploadOk = 0;
 }
 
 // Check file size
 if ($_FILES["fileToUpload"]["size"] > 500000) {
  $error= "Sorry, your file is too large.";
   $uploadOk = 0;
 }
 
 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  ) {
    $error= "Sorry, only JPG, JPEG, PNG files are allowed.";
   $uploadOk = 0;
 }
 
 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
  $error= "Sorry, your file was not uploaded.";
 // if everything is ok, try to upload file
 } else {
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $error= "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
 
    $sql = "INSERT INTO form2 (file) VALUES ('$target_file')";
                  
 
   } else {
    $error= "Sorry, there was an error uploading your file.";
   }
 }  
}



?>