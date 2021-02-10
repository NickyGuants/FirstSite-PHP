<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first php website</title>
</head>
<?php
session_start();
if($_SESSION['user']){

}else{
    header("location: index.php");
}
$user=$_SESSION['user'];
$mysqli=mysqli_connect("localhost","root","","first_db");
if(mysqli_connect_errno()){
    echo "Failed to connect to the database:". mysqli_connect_error();
}
?>
<body>
    <h2>Home Page</h2>
    <a href="logout.php">log Out</a><br/><br/>
    <p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
    <form action="add.php" method="POST">
        Add more to list: <input type="text" name="details" /> <br/>
        Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
        <input type="submit" value="Add to list"/>
    </form>
    <h2 align="center">My list</h2>
    <table border="1px" width="100%">
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Public Post</th>
        </tr>
        <?php
        $query=mysqli_query($mysqli,"SELECT * from list");
        while($row=mysqli_fetch_array($query)){
            Print "<tr>";
                Print '<td align="center">'. $row['ID'] . "</td>";
                Print '<td align="center">'. $row['details'] . "</td>";
                Print '<td align="center">'. $row['date_posted'] . 
                    " - " . $row['time_posted'] . "</td>";
                Print '<td align="center">'. $row['date_edited'] . 
                    " - " . $row['time_edited'] ."</td>";
                Print '<td align="center"><a href="edit.php">edit</a> </td>';
                Print '<td align="center"><a href="delete.php">delete</a> </td>';
                Print '<td align="center">'. $row['public'] . "</td>";
            Print "</tr>";
        }

        ?>
    </table>
</body>
</html>