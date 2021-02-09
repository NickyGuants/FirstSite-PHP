<?php
session_start();
$mysqli=mysqli_connect("localhost","root", "","first_db");
if(mysqli_connect_errno()){
    echo "Failed to connect to the database:". mysqli_connect_error();
}else{
    echo "connected";
}
$username=mysqli_real_escape_string($mysqli,$_POST['username']);
$password=mysqli_real_escape_string($mysqli,$_POST['password']);
$bool=true;

$query="SELECT * from users WHERE username='$username'";
$result=mysqli_query($mysqli,$query);
$exists=mysqli_num_rows($result);
$table_users="";
$table_password="";
if($exists>0){
    while($row=mysqli_fetch_assoc($result)){
        $table_users=$row['username'];
        $table_password=$row['password'];
        echo $username;
    }
    if(($username==$table_users) && ($password==$table_password)){
        if($password==$table_password){
            $_SESSION['user']=$username;
            header("location: home.php");
        }
    }else{
        Print '<script>alert("Incorrect Password!");</script>'; 
        Print '<script>window.location.assign("login.php");</script>';
    }
}else{
    Print '<script>alert("Incorrect username!");</script>';
    Print '<script>window.location.assign("login.php");</script>';
}
?>