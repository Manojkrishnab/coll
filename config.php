<?php 


$conn = new mysqli('localhost','admin','1234','college');
if($conn->connect_error){
    die("connection error");
}

?>