<?php
include "config.php";
echo

    $nameErr = $checkbox = $emailErr = $passwordErr = $regist = $regist1 = $add = $pass = $selectError = $check = "";
// echo $regist1;
if (isset($_POST['submit'])) {

    //  echo  $selectError;

    //  sitekey="6Le7VcYnAAAAANgYd_rAR2vtJAu8m07mWKmHiVLG"
    // $secretAPIkey = '6Le7VcYnAAAAAPHZVoc3CH2Ut6r36WcoaVRBmjBi';

    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];

    $email = $_POST["email"];
    $address = $_POST["address"];
    $course1 = $_POST["course1"];
    $course2 = $_POST["course2"];
    $subject = $_POST["subject"];
    $password = $_POST["password"];
    $conformpassword = $_POST["conformpassword"];
    $gender = $_POST["gender"];
    $recaptchaResponse = $_POST["g-recaptcha-response"];


    $secretKey = '6Le7VcYnAAAAAPHZVoc3CH2Ut6r36WcoaVRBmjBi';


    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseData = json_decode($response);



    if (empty($_POST["firstname"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
            $nameErr = "Only letters and white space allowed";
            $regist1 = "Registration unsuccessful";
            $conn->close();
        }
    }

    if (empty($_POST["lastname"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["lastname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
            $nameErr = "Only letters and white space allowed";
            $regist1 = "Registration unsuccessful";
            $conn->close();
        }
    }

    if (strlen($address) > 50) {
        $add = "Address should not exceed 50 characters";
        $regist1 = "Registration unsuccessful";
    }
    if (empty($_POST["subject"])) {
        $selectError = "please choose one option";
        $regist1 = "Registration unsuccessful";
        $conn->close();

    }
    if (empty($_POST["course1"]) && empty($_POST["course2"])) {
        $checkbox = "At least one course should be selected";
        $regist1 = "Registration unsuccessful";
        $conn->close();
    }


    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $regist1 = "Registration unsuccessful";
            $conn->close();
        } else {
            $ins = "SELECT * FROM form WHERE email='$email'";
            $result = $conn->query($ins);
            if ($result->num_rows >= 1) {
                $emailErr = "Email is already taken please login";
            } else {
                if ($password === $conformpassword) {
                    $testPassword = $password;
                    $testHash = password_hash($testPassword, PASSWORD_DEFAULT);


                    $sql = "INSERT INTO form (firstname, lastname, email, address, course1, course2, subject, password, gender) VALUES ('$first_name','$last_name','$email','$address','$course1','$course2','$subject','$testHash','$gender')";
                    if ($responseData->success) {
                        if ($conn->query($sql) === TRUE) {
                            $regist = "Registration successful";
                            $emailErr = "";
                            $to = "prasan.shivarapu@gmail.com";
                            $subject = "HTML email";
                            $message = "
                                <html>
                                <head>
                                <title>HTML email</title>
                                </head>
                                <body>
                                <p>This email contains HTML Tags!</p>
                                     <p><?php echo $first_name
                                     ; ?<p/>    
                                     <p><?php echo $email; ?<p/> 
                                     <p><?php echo $address; ?<p/>   
                                </body>
                                </html>
                                ";

                            // Always set content-type when sending HTML email
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                            // More headers
                            $headers .= '158r1a03j5@gmail.com.com>' . "\r\n";


                            mail($to, $subject, $message, $headers);

                        } else {
                            $regist1 = "Registration unsuccessful";
                            // echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                    } else {
                        $check = "reCAPTCHA verification failed.";

                    }




                } else {
                    $pass = "Passwords do not match";
                    $regist1 = "Registration unsuccessful";
                }


            }
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <style>
        body {
            padding: 25px;
            background-color: #f2f2f2;
        }

        .error {
            color: #FF0000;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .inputst {
            width: 80%;
        }

        .inputstt {
            width: 90%
        }

        .head {
            font-weight: bold;
            font-size: 35px;
            font-family: 'Helvetica Neue', sans-serif;
        }

        .st {
            font-family: 'Lato', sans-serif;
            font-size: 20px;

        }

        .stu {
            font-family: 'Lato', sans-serif;
            font-size: 18px;
            margin-right: 3px;

        }

        .form {
            background-color: #f2f2f2;
            padding: 10px;
        }

        .std {
            margin-right: 5px;
        }
    </style>
    <title>User Registration</title>
</head>

<body>
    <h2 class="head">Signup Form</h2>

    <div class="container">
        <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="firstname" class="form-label mt-2 st">First name</label>
                    <input type="text" class="form-control inputst" id="firstname" name="firstname"
                        value="<?php echo $first_name; ?>" required>
                    <?php if (!empty($nameErr)) { ?>
                        <span class="error">
                            <?php echo $nameErr; ?>
                        </span>
                    <?php } ?>
                </div>


                <div class="col-sm-12 col-md-6">
                    <label for="lastname" class="form-label mt-2 st">Last name</label>
                    <input type="text" class="form-control inputst" id="lastname" name="lastname"
                        value="<?php echo $last_name; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="email" class="form-label mt-2 st">Email</label>
                    <input type="email" class="form-control inputst" id="email" name="email" required>
                    <?php if (!empty($emailErr)) { ?>
                        <span class="error">
                            <?php echo $emailErr; ?>
                        </span>
                    <?php } ?>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="mt-2 st">Select branches</label>
                    <select required class="form-select inputst mb-2" name="subject"
                        aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                        <option value="CSE">CSE</option>
                        <option value="IT">IT</option>
                        <!-- <option value="3" name="subject">Three</option> -->
                    </select>
                    <?php if (!empty($selectError)) {
                        ?> <span class="error">
                            <?php echo $selectError; ?>
                        </span>
                    <?php }
                    ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="password" class="form-label st mt-2">Password</label>
                    <input type="password" name="password" class="form-control inputst" id="password" name="password"
                        required>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label for="cpassword" class="form-label st mt-2">Confirm Password</label>
                    <input type="password" name="conformpassword" class="form-control inputst" id="cpassword"
                        name="password" required>
                </div>
                <?php if (!empty($pass)) { ?>
                    <span class="error">
                        <?php echo $pass; ?>
                    </span>
                <?php } ?>

            </div>




            <div class="row">
                <div class="col-12">
                    <label class="form-label mt-2 st">Address</label>
                    <textarea name="address" required class="form-control inputstt"></textarea>
                    <?php if (!empty($add)) { ?>
                        <span class="error">
                            <?php echo $add; ?>
                        </span>
                    <?php } ?>
                </div>
            </div>

            <div class="row mt-2">

                <div class="col-sm-12 col-md-6">
                    <label class="mt-2 st" for="cou"> Semisterwise</label><br>
                    <div class="">
                        <label for="cou" class="stu">semister-1</label>
                        <input class="mr-2 std" id="cou" type="checkbox" name="course1" value="First-semister" /> <br>
                        <label for="cour" class="stu">semister-2</label>
                        <input class="ml-2 std mr-3" id="cour" type="checkbox" name="course2" value="Second-semister" />
                        <?php
                        if (!empty($checkbox)) {
                            ?><span class="error">
                                <?php echo $checkbox ?>
                            </span>
                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="gen" class="mt-3 st">Gender</label><br>
                    <label class="stu"><input id="gen" type="radio" name="gender" value="male" required>
                        Male</label><br>
                    <label class="stu"><input id="gen" type="radio" name="gender" value="female" required>
                        Female</label><br>

                </div>
            </div>






            <div class="row">
                <div class="g-recaptcha" data-sitekey="6Le7VcYnAAAAANgYd_rAR2vtJAu8m07mWKmHiVLG"></div>
                <?php
                if (!empty($check)) {
                    ?> <span class="error">
                        <?php echo $check; ?>
                    </span>
                    <?php
                }
                ?>

            </div>


            <div class="col-sm-12 col-md-6">
                <button class="btn btn-primary mt-3 st" type="submit" name="submit">Submit</button><br>
                <?php if (!empty($regist)) { ?>
                    <span class="success mt-3">
                        <?php echo $regist; ?>
                    </span>
                <?php } ?>
                <?php
                if (empty($regist)) { ?>
                    <span class="error mt-3">
                        <?php echo $regist1; ?>
                    </span>
                <?php } ?>
            </div>
            <p class="mt-3"> if registered <a href="login.php"> login here </p>
    </div>
    </form>

    </div>


</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</html>