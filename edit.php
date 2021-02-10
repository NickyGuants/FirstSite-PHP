<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Website</title>
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
    <p>Hello <?php Print "$user"?>!</p> <!--Display's user name-->
    <a href="logout.php">Log Out</a><br/><br/>
    <a href="home.php">Return to home page</a>
    <h2 align="center">Currently Selected</h2>
    <table border="1px" width="100%">
	    <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Public Post</th>
		</tr>
        <?php
            $mysqli=mysqli_connect("localhost", "root", "","first_db");
            if(!empty($def['ID'])){
                $id=$_GET['ID'];
                $_SESSION['ID']=$id;
                $id_exists=true;
                $query=mysqli_query($mysqli,"SELECT * from list");
                $count=mysqli_num_rows($query);
                if($count>0){
                    while($row=mysqli_fetch_array($query)){
                        Print "<tr>";
                            Print '<td align="center">' . $row['ID'] . "</td>";
                            Print '<td align="center">' . $row['details'] . "</td>";
                            Print '<td align="center">' . $row['date_posted'] . 
                                " - " . $row['time_posted']."</td>";
                            Print '<td align="center">' . $row['date_edited'] . 
                                " - " . $row['time_edited']."</td>";
                            Print '<td align="center">' . $row['public'] . "</td>";
                        Print "</tr>";
                    }
                }else{
                    $id_exists = false;
                }
            }
        ?>
    </table>
    <br>
    <?php
        if($id_exists){
            Print '
            <form action="edit.php" method="post">
                Enter new detail: <input type="text" name="details"/><br/> 
                public post? <input type="checkbox name="public[]" value="yes"/><br/> 
                <input type="submit" value="Update List"/> 
            </form> 
            '; 
            }else{
                Print '<h2 align="center">There is no data to be edited.</h2>';
            } 
    ?>
</body>
</html>
<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $mysqli=mysqli_connect("localhost", "root", "","first_db");
      $details = mysqli_real_escape_string($mysqli,$_POST['details']);
      $public = "no";
      $id = $_SESSION['ID'];
      $time = strftime("%X"); //time
      $date = strftime("%B %D, %Y"); //date

      foreach($_POST['public'] as $list)
      {
         if($list != null)
         {
            $public = "yes";
         }
      }
      mysqli_query($mysqli,"UPDATE list SET details='$details',
      public='$public', date_edited='$date', time_edited='$time' WHERE ID='$id'");
      header("location:home.php");
   }
?>