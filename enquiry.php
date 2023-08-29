 <?php 
 session_start();

 if(!isset($_SESSION["email"] )){
    header("Location: login.php");
    exit();
}


// $cookie_name="a";
// $cookie_value="b";


// session_start();



$stu = "";
 include  "config.php";
 $firstname=$error="";
 $firstname = "";
$lastname = "";
$email = "";
$address = "";
$subject = "";
$gender = "";
$error = "";
$crt="";
$stu="" ;
// $number = "";

 if (isset($_GET['email'])) {
    $email = $_GET['email'];

     $sql = "SELECT * FROM  form WHERE email='$email'";

    //  $_SESSION["favcolor"]

 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
// echo $row['subject'];



//             $na = "SELECT COUNT(*) AS total_rows FROM form2";
//             $re= $conn->query($na)  ;
//             // $pr = $re->fetch_assoc();
//             // echo sizeof($pr) ;
//             // $reslt = mysqli_query($conn, $na);
//             // echo $reslt ;


//             if ($re->num_rows > 0) {
//                 $ro = $re->fetch_assoc();
//                 $totalRows = $ro['total_rows'];
//                $number= $totalRows;
//             } else {
//                 $number = 0 ;
//             }
// $conn->close();


            
 $_SESSION["firstname"] = $row['firstname'];
 $_SESSION["lastname"] = $row['lastname'];
 $_SESSION["email"] = $row['email'] ;
 $_SESSION["address"]  = $row['address'];
 $_SESSION["subject"] = $row['subject'];
 $_SESSION["gender"] = $row['gender']; 
//  echo $row['student_id'];
 $_SESSION["stu"] = $row['student_id'];
 $_SESSION["sem"] = $row['course1'];
 $_SESSION["sem2"] = $row['course2'];
// echo  $row['course1'];
// echo  $row['course2'];

// echo  $_SESSION["subject"] ;
//  $firstname= $row['firstname'];
//  $lastname=  $row['lastname'];
//  $address = $row['address'];
//  $subject = $row['subject'];
//  $gender = $row['gender']; 
}
$stu = $_SESSION["stu"];
// echo $stu;
if (isset($_POST["submit"])) {
     
   $name= $_POST["name"] ;
    


 

     $targetDir = "uploads/"; 
    

    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    // echo $targetFile ;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // echo $imageFileType ;
    // $newFileName = uniqid() . "_" . $name . "." . $imageFileType;

    // $targetFile = $targetDir . $newFileName;

    // Check if file already exists
    if (file_exists($targetFile)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
        
    }

    // Check file size (adjust as needed)
    // Check file size (adjust as needed)
// Check file size (adjust as needed)
if ($_FILES["fileToUpload"]["size"] > 15000000) {
    // echo "File size: " . $_FILES["fileToUpload"]["size"] . "<br>"; // Debug
    // echo "Maximum allowed size: 15000000<br>"; // Debug
    $crt  =  "Sorry, your file is too large."; 
    $uploadOk = 0;
}



    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "pdf") {
            $error ="Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error =  "Sorry,file already exists, your file was not uploaded.";
    } else {

        $newFileName = uniqid() . "_" . $name . "." . $imageFileType;
        // echo $newFileName ;
        // echo $targetDir ;
        // $targetFile = $targetDir . $newFileName;
        $target_file = $newFileName ;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            // $error = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            
       
            $db = "INSERT INTO form2 (student_id,file,document_name) VALUES  ('{$_SESSION["stu"]}','$newFileName','$name')";
        if($conn->query($db)===TRUE){
            $crt =  "File has been uploaded";
        }else{
            $error = "file is not  inserted";
        }
       
       
        } else {
            $error =  "Sorry, there was an error uploading your file.";
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .main {
            background-color: #bec6cc;
            min-height: 100vh;
            padding: 20px;
        }
        .head {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 28px;
            color: rgb(88, 86, 86);
            margin-bottom:50px;
        }
        .input{
    padding: 10px;
    border: 1px solid #faf7f7;
    border-radius: 5px;
    width: 300px;
    font-size: 16px;
    margin-bottom: 10px;
        }
        p{
            font-size: 18px;
    color: #333;
    /* line-height: 1.6; */
    /* margin-bottom: 15px; */
    
    /* padding-left: 10px; */
        }
        .red{
          color:red;

        }
        .green{
            color:green;
        }
        .inputst{
            background-color:transparent;
            border-width:1px;
            border-color:white;
            height:50px;
            margin-bottom:10px;
        }
        .pk{
            margin-right:10px;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="d-flex flex-row justify-content-between">

        <h1 class="head">Student Dashboard</h1>
        <a href="  logout.php" ><button class="btn btn-secondary">Logout</button> </a>
        
        </div>
        
        <div class="container">
        <div class="row">
               
               <div class="col-sm-12 col-md-4">
                   <p>First Name</p>
                   <input disabled class="input" value="<?php echo $_SESSION["firstname"] ; ?>" type="text" />
               </div>
               <div class="col-12 col-md-4">
                   <p>Last Name</p>
                   <input disabled class="input" value=" <?php echo $_SESSION["lastname"] ;?>"  type="text" />
               </div>
               <div class="col-12 col-md-4">
                   <p>Email</p>
                   <input disabled class="input" value=" <?php echo  $_SESSION["email"] ;?>" type="text" />
               </div>
           </div>
           <div class="row">
               <div class="col-12">
                   <p>Address</p>
                   <textarea disabled class="input"><?php echo $_SESSION["address"]; ?></textarea>
           </div>
           </div>
           <div class="row">
               <div class="col-12 col-md-4 d-flex flex-row justify-content-start">
                   <p>Selected branch :</p>
                   <p><?php echo $_SESSION["subject"] ; ?></p>
               </div>
               <div class="col-12 col-md-4 d-flex flex-row justify-content-start">
                   <p>Gender :</p>
                   <p><?php echo $_SESSION["gender"]; ?></p>
               </div>
               <div class="col-12 col-md-4 d-flex flex-row justify-content-start">
    <p>Semester :</p>
    <div class="mt-1 pk">
        <?php echo isset($_SESSION["sem"]) ? $_SESSION["sem"] : ''; ?>
    </div>
    <div class="mt-1 ">
        <?php echo isset($_SESSION["sem2"]) ? $_SESSION["sem2"] : ''; ?>
    </div>
</div>

        </div>
<!-- <p> No of  documents: <?php echo  $number ; ?> </p> -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
   
          
             
           
             
            
            <div class="row mt-5">

            <div class="col-sm-12 col-md-6">
             <p> Documents</p>
             <input placeholder="specify the document type" type="text" class="form-control inputst" id="firstname" name="name" required>

            <!-- <?php if (!empty($nameErr)) { ?>
                <span class="error"> <?php echo $nameErr; ?></span>
            <?php } ?> -->
            </div>

   



                      <div class="col-12 col-md-6"> 
                           <p>File Upload</p>
                           <input required  class="input" type="file"  name="fileToUpload" id="fileToUpload"/>  <br>
                       





                    <!-- <?php if (!empty($regist)) { ?>
                                            <span class="success mt-3"> <?php echo $regist; ?></span>
                                        <?php } ?>
                                        <?php 
                                        if(empty($regist))
                                        {?>
                                        <span class="error mt-3"> <?php echo $regist1; ?></span>
                                    <?php  } ?> -->






                          </div>
                </div>
                
                <button class="btn btn-primary mt-3" type="submit" value="Upload Image" name="submit">submit </button> <br>
                  <?php 
                        if(!empty($crt)){
                          ?> <span class="green"> <?php echo $crt ; ?></span>
                      <?php  } 
                        ?>
                        <?php 
                        if(empty($crt)){
                            ?>  <span class="red"> <?php  echo $error ?></span> <?php 
                        }
                        ?>
                        </form>      
              </div>
    </div> 

</body>
</html>
