<?php
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $id=$_POST['id'];
    $conn=mysqli_connect("localhost","root","","data");
    $sql="INSERT INTO info VALUE($id,'$first_name','$last_name')";
    if (mysqli_query($conn,$sql)) {
        echo 1;
    }
    else 
    {
        echo 0;
    }

?>