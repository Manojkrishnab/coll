<?php 
session_start();

if(isset($_SESSION["email"] )){
  header("location:enquiry.php?email=" . urlencode($_SESSION["email"]));
    exit();
}
 include "config.php";
 $erroremail="";
 $passworderror="";
if(isset($_POST["submit"])){
   $email= $_POST['email'];
   $password=$_POST['password'] ;
   $address = $_POST["address"];
   
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $erroremail="Invalid email format";
   }else{
   $sql = "SELECT * FROM form WHERE email='$email'";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   

$passw01= $row['password'];
// $to =  $password;

//    $test02 = password_verify($password,$passw01);
  
    if($result->num_rows===1){
        if(password_verify($password,$passw01)){
          $_SESSION["email"] = $email ;
           header("location:enquiry.php?email=" . urlencode($_SESSION["email"]));
          }else{
              $passworderror="Password is invalid";
          }
    }else{
        $erroremail="Email Id not exist please register";
    }
    

}
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .log{
            height:100vh;
          display:flex;
          background-image: linear-gradient( #555CB5, #8B4A87);
          background-image: linear-gradient( #dbddfc, #f0cced);
          background-image: linear-gradient( #dbddfc, #9df0ec);
          flex-direction:column;
          justify-content:center;  
          align-items:center;
          
        }
        .shadow-box {
    width: 200px;
    height: 200px;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

        .login{
            flex-direction:column;
            background-color:white;
            border:solid;
            border-color:silver;
            min-height:200px;
            border-width:1px;
            border-radius:5px;
            width:100%;
            padding:10px;
           
    
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .inputst {
          min-width: 300px;
          margin-bottom:5px;
        }
        .red{
            color:red;
            
          height:10px;
           
        }
        .head{
          font-weight:bold;
          font-size:35px;
         font-family: 'Helvetica Neue', sans-serif;
        }
        .st{
           font-family: 'Lato', sans-serif;
           font-size:18px;

        }
    </style>
    <title >Student Login</title>
</head>
<body> 
     
 <div class="log">
    
      <form class="row g-3 needs-validation" class="login" method="post" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>" >
          <div class="login"> 
                <h1  class="head"> Student Login</h1> 
          <div class="col-md-4 w-100">
    <label for="validationCustom01" class="form-label st" >Email</label>
    <input type="text" class="form-control inputst " id="validationCustom01" name="email" required />
    
    <?php
    if(!empty($email)){
        ?> <span class="red inputst"><?php  echo $erroremail ;?> </span> <?php
    }
    ?>
    
  </div>
  <div class="col-md-4 w-100">
    <label for="validationCustom02" class="form-label st">Password</label>
    <input type="password" class="form-control inputst " id="validationCustom02" name="password"  required  />
    <?php
      if(!empty($passworderror)){
        ?> <span class="red inputst"> <?php echo $passworderror; ?></span> <?php
      }
    ?>
  </div>
  <div class="col-12">
    <button class="btn btn-primary mt-3 mb-2" type="submit" name="submit">Login </button>
  </div>
  <span> Not a member ? </span>
  <a href="index.php">register here </a>
    </div>
</form>
</div>
</body>
</html>    


