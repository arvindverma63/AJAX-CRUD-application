<?php
  $first_name=$_POST['fname'];
  $last_name=$_POST['lname'];
  $id=$_POST['id'];
  $conn=mysqli_connect("localhost","root","","data");
  $sql="UPDATE info SET fname = '$first_name', lname = '$last_name' WHERE id = '$id'";
  if (mysqli_query($conn,$sql)) {
      echo 1;
  }
  else 
  {
      echo 0;
  }
?>