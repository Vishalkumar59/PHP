<?php

//connect php with database
$conn= mysqli_connect('localhost','root','','student');
if(!$conn)
{
echo("connection failed with mysql".mysqli_connect_error());
}else{
//echo"successfully connected";
}
?>