<?php
$id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "data");

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM info WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>
    <tr>
        <td>Id: </td>
        <td><input type='text' id='edit-Id' value='<?php echo $row['id']; ?>'></td>
    </tr>
    <tr>
        <td>First Name: </td>
        <td><input type='text' id='edit-first' value='<?php echo $row['fname']; ?>'></td>
    </tr>
    <tr>
        <td>Last Name: </td>
        <td><input type='text' id='edit-last' value='<?php echo $row['lname']; ?>'></td>
    </tr>
    <tr>
        <td><input type='submit' id='Edit'></td>
    </tr>
    <?php
}

// Close the prepared statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
