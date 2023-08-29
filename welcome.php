<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap.css">
        <style>
            *{
                margin: 0px;
                box-sizing: border-box;
            }
            .name-para{
                color: #000;
                font-family: Arial,sans-serif;
                font-weight: 600;
                font-size: 18px;
                text-transform: uppercase;
            }
            .mail-para{
                color: #000;
                font-family: Arial,sans-serif;
                font-weight: 600;
                font-size: 18px;
            }
            .top-section{
                background-image: url("https://milifoundation.org/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-27-at-6.53.58-PM-e1661607643687-1024x571.jpeg");
                background-size: cover;
                /* height: 30vh; */
            }
            img{
                height: 45vh;
                width: 100%;
            }
            .middle-section{
                background: lightpink;
                height: 60vh;
            }
            .heading{
                color: #BB2D3B;
                text-align: center;
                font-weight: bold;
                font-family: Arial,sans-serif;
            }
            .label{
                font-family: Arial,sans-serif;
            }
            .submit-button{
                border: 0;
                background: blue;
                color: #FFFFFF;
                font-family: Arial,sans-serif;
                padding: 7px;
                border-radius: 7px;
                font-size: 15px;
                width: 100px;
                font-weight: 500;
            }
            .header-section{
                background: #D8D8D8;
            }
        </style>
    </head>
    <body>
        
        <?php 
            if (isset($_GET['email'])) {

               include "config.php" ;

                $login_mail = $_GET['email'];

                $sql = "SELECT * FROM form2 WHERE email = 'file'";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $studentName = $row['fullname'];
                $studentMail = $row['email'];

                $conn->close();
                // echo $_GET['email'];
            }
        ?>

        <header>
            <div class="container">
                <div class="header-section">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <p class="name-para"><?php echo $studentName ?></p>
                        <p class="mail-para"><?php echo $studentMail ?></p>
                        <a href="signinform.php"><button class="btn btn-danger">SignOut</button></a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <img src="coverpic.png" alt="image">
        </div>
        <div class="container">
            <div class="middle-section">
                <div class="student-details mt-2 d-flex flex-column align-items-center">
                    <h1 class="heading mt-2">Welcome to your Account!</h1>
                    
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                    <table>
                        <div class="mt-3">
                            <tr>
                                <td><label class="label"><strong>Enter Title: </strong></label> </td>
                                <td><input type="text" name="fileTitle" id="fileTitleName" placeholder="Enter Title Name"></td>
                            </tr>
                        </div>
                        <div>
                            <tr>
                                <td><label class="mt-3 label"><strong>Select File to upload: </strong></label></td>
                                <td><input class="mt-3" type="file" name="fileToUpload" id="fileToUpload"></td>
                            </tr>
                            <tr>
                                <td><span>(Upto 15MB)</span></td>
                            </tr>
                        </div>
                        </table>
                        <div class="mt-3" align="center">
                            <input class="submit-button" type="submit" value="SUBMIT" name="submit">
                        </div>
                    </form>      

                </div>
            </div>
        </div>
        
    </body>
</html>