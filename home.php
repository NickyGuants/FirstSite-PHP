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
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </table>
</body>
</html>