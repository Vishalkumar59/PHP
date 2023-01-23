<?php
$conn= mysqli_connect('localhost','root','','student');

if(isset($_GET['del'])){
    $del_id=$_GET['del'];

    $delete= "DELETE FROM information WHERE id= '$del_id'";

    $delete_run= mysqli_query($conn,$delete);
    if($delete_run === true){  
        echo"<script>alert('your record is deleted')</script>";
    header('location:show.php');  
}
    else{
        echo "failed try again !";
    }
}
?>