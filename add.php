<?php
session_start();
if($_SESSION['user']){
    
}else{
    header("location: index.php");
}
$mysqli=mysqli_connect("localhost","root","","first_db");
if(mysqli_connect_errno()){
    echo "Failed to connect to the database:". mysqli_connect_error();
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $details=mysqli_real_escape_string($mysqli,$_POST['details']);
    $time=strftime("%X");
    $date=strftime("%B %d %Y");
    $decision="no";
    foreach($_POST['public'] as $each_check){
        if($each_check !=null){
            $decision="yes";
        } 
    }
    mysqli_query($mysqli,"INSERT INTO list (details, date_posted, time_posted, public) 
    VALUES ('$details', '$date','$time','$decision')");
    header("location: home.php");
}else{
    header("locatiom: home.php");
}
?>