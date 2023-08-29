<?php 

 include "config.php" ;

 $db = " SELECT * FROM form2 WHERE document_name= 'erty' " ;

 $result = $conn->query($db);
 $row = $result->fetch_assoc();

 $image =  $row['file'];




 ?>
 <DOCTYPE html>
    
<body>
 
   <?php echo $image; ?>
 <img src="<?php echo $image; ?>">
 
    

</body>      