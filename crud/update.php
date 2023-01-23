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

<?php
        //create conncetion
        $conn= mysqli_connect('localhost','root','','student');

        if(isset($_GET['edit'])){
            $edit=$_GET['edit'];
        //select table
        $select="SELECT * FROM information WHERE id=$edit";

        //check connection and select query
        $run=mysqli_query($conn,$select);

        // fetch the array and looping
        while($fetch_arr=mysqli_fetch_array($run)){

          //create a variable for each colomn name which is available in database
        $name= $fetch_arr['name'];   //database colomn name=name in 
        $dob= $fetch_arr['dob'];   
        $contact= $fetch_arr['contact'];   
        $rollnumber= $fetch_arr['rollnumber'];
        ?>
<div class="container">
  <h2>Student Details update Form</h2>

 
  <form action="" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text"  id="name" class="form-control" placeholder="Enter name" value="<?php echo $name;?>" name="name" >
    </div>
    <div class="form-group">
      <label for="dob">DOB:</label>
      <input type="date" class="form-control" placeholder="Enter date of birth" value="<?php echo $dob;?>" name="dob">
    </div>
     <div class="form-group">
      <label for="contact">CONTACT:</label>
      <input type="int" class="form-control" placeholder="Enter phone number" value="<?php echo $contact;?>" name="contact">
    </div>
     <div class="form-group">
      <label for="rollnumber">ROLL NUMBER:</label>
      <input type="int" class="form-control" placeholder="Enter roll number" value="<?php echo $rollnumber;?>" name="rollnumber">
    </div>
    
  
    <button type="submit" name="update" class="btn btn-primary">UPDATE</button>
  </form>

</div>

<?php
 }
if(isset($_POST['update'])){
  $name=$_POST['name'];
  $dob=$_POST['dob'];
  $contact=$_POST['contact'];
  $rollnumber=$_POST['rollnumber'];
  $sql="UPDATE information SET name='{$name}',dob='{$dob}',contact='{$contact}',rollnumber='{$rollnumber}' WHERE id=$edit";
  $result=mysqli_query($conn,$sql);
  if($result){
    
    header('localhost:show.php');

  }
 
}

}

 
 ?>
</body>
</html>



  