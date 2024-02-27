<?php
   $first_name=$_POST['search'];
   $conn=mysqli_connect("localhost","root","","data");
   $query="select * from info where fname like '%$first_name%' or lname like '%$first_name%' or id like '%$first_name%'";
   $result=mysqli_query($conn,$query);

   if(mysqli_num_rows($result)>0){
       echo "<table id='tables'>
       <tr id='head'>
           <th>Id</th>
           <th>First Name</th>
           <th>Last Name</th>
           <th>Edit</th>
           <th>Delete</th>
       </tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['fname']."</td>
                <td>".$row['lname']."</td>
                <td><button class='edit-button' data-eid='{$row["id"]}'>Edit</button></td>
                <td><button class='delete' data-id='{$row["id"]}'>Delete</button></td>
            </tr>
        </table>";
        }
   }

?>