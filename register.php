<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My first Php website</title>
</head>
<body>
    <h2>Registration page</h2>
    <a href="index.php">Home</a> <br><br>
    <form action="register.php" method="POST">
        Enter Username: <input type="text" name="username" required="required"><br>
        Enter Password: <input type="password" name="password" required="required"><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
<?php
    $mysqli=mysqli_connect("localhost", "root", "", "first_db");
    if(mysqli_connect_errno()){
        echo "Failed to connect to the database:". mysqli_connect_error();
    }else{
        echo "connected";
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username=mysqli_real_escape_string($mysqli,$_POST['username']);
        $password=mysqli_real_escape_string($mysqli,$_POST['password']);
        echo "Username Entered is: ". $username."<br/>";
        echo "Password Entered is: ". $password."<br/>";

        $bool=true;
        
        $query="SELECT * from users";
        $result=mysqli_query($mysqli,$query);
        while($row= mysqli_fetch_array($result)){
            $table_users=$row['username'];
            if($username==$table_users){
                $bool=false;
                Print '<script>alert("Username has been taken!");</script>';
            }
        }
        if($bool){
            mysqli_query($mysqli,"INSERT INTO users (username, password) VALUES ('$username','$password')" );
            Print '<script>alert("Successfully Registered!");</script>';
        }
    }
    mysqli_close($mysqli);
?>