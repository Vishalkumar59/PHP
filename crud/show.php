<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Student details</h2>
        
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>dob</th>
        <th>contact</th>
        <th>rollnumber</th>
        <th>operation</th>
        
      </tr>
    </thead>

    <tbody>

        <?php
        //create conncetion
        $conn= mysqli_connect('localhost','root','','student');

        //select table
        $select="SELECT * FROM information";

        //check connection and select query
        $run=mysqli_query($conn,$select);

        // fetch the array and looping
        while($fetch_arr=mysqli_fetch_array($run)){

          //create a variable for each colomn name which is available in database
        $id= $fetch_arr['id'];   //database colomn name=id in []
        $name= $fetch_arr['name'];   //database colomn name=name in 
        $dob= $fetch_arr['dob'];   
        $contact= $fetch_arr['contact'];   
        $rollnumber= $fetch_arr['rollnumber'];
        ?>

        
      <tr>
      <!-- /*print the all colomn name variable of table */ -->

        <td> <?php echo $id;?> </td>
        <td> <?php echo $name;?> </td>
        <td> <?php echo $dob;?> </td>
        <td> <?php echo $contact;?> </td>
        <td> <?php echo $rollnumber;?> </td>
        <td> <a href="delete.php?del=<?php  echo $id; ?>">delete<a> </td>
        <td> <a href="update.php?edit=<?php  echo $id; ?>">update<a> </td>
        <?php } ?>
    </tr>
    
    </tbody>
  </table>
</div>

</body>
</html>
