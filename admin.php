
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" type="text/css" href="index.css">
  <script src="https://kit.fontawesome.com/97d27865aa.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>







  <div>
    <table class="table">
      <thead>
        <tr class="table-primary">
           <th >Firstname</th>
           <th>Lastname</th>
           <th>Email</th>
           <th>Address</th>
           
        </tr>
      </htead>
        <tbody>


        <?php 
        include "config.php";
$sql = "SELECT * FROM form";

$result = $conn->query($sql);

        if($result->num_rows  > 0){
          
          while ($row = $result->fetch_assoc()) { 
         
            ?> 
         <tr class="table table-striped">
             <td ><?php echo $row['firstname']; ?></td>
              <td><?php echo $row['lastname'];?> </td>
              <td><?php echo $row['email'];?> </td>
              <td> <?php echo $row['address']; ?></td>
               <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete   |</a> 
             
              <a href="up.php?id=<?php echo $row['id'];  ?>">update</a><td> -->
            </tr> 

            
            <?php 
          }
        }else{
          echo "Data not found";
        
         
        }
       ?>
            

           
        </tbody>
      
    </table>







 
  </div>
</body>
</html> 