<?php
   $id=$_POST['id'];
   $conn=mysqli_connect("localhost","root","","data");
   $query="DELETE FROM info WHERE id='$id'";
   $result=mysqli_query($conn,$query);
   if($result){
       echo 1;
   }
   else{
       echo 0;
   }

?>