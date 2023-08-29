<?php
include  "config.php";
include "m.php" ;
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM form WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $address = $row['address'];
    $subject = $row['subject'];
    $gender = $row['gender'];
    $conn->close();
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
            margin-bottom: 50px;
        }
        .input {
            padding: 10px;
            border: 1px solid #faf7f7;
            border-radius: 5px;
            width: 300px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .red {
            color: red;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1 class="head">Student Dashboard</h1>
        <p><?php echo $firstname ?></p>
        <p><?php echo $firstname ?></p>
        <p><?php echo $firstname ?></p>
        <p><?php echo $firstname ?></p>
        <form action="m.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <?php
            if (!empty($error)) {
                ?>
                <span><?php echo $error; ?></span>
            <?php
            }
            ?>
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</body>
</html>
