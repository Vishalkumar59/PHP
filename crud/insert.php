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
  <h2>Student Details Form</h2>
  <form action=" " method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="dob">DOB:</label>
      <input type="date" class="form-control" placeholder="Enter date of birth" name="dob">
    </div>
     <div class="form-group">
      <label for="contact">CONTACT:</label>
      <input type="int" class="form-control" placeholder="Enter phone number" name="contact">
    </div>
     <div class="form-group">
      <label for="rollnumber">ROLL NUMBER:</label>
      <input type="int" class="form-control" placeholder="Enter roll number" name="rollnumber">
    </div>
    
  
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


<?php
//php connection with database
include('conn.php');

if(isset($_POST['submit'])){
$name=$_POST['name']; //form name=name value in []
$dob=$_POST['dob']; //form name=dob value in []
$contact=$_POST['contact']; //form name=contact value in []
$rollnumber=$_POST['rollnumber']; //form name=rollnumber value in []


//insert query 
echo "INSERT INTO `information`(`name`,`dob`,`contact`,`rollnumber`) VALUES('$name','$dob','$contact','$rollnumber')";
$query= mysqli_query($conn,$ins);

//check query
if($query === true){
echo "data has been inserted";
}
else{
    echo "failed";
}
}
?>

</body>
</html>
