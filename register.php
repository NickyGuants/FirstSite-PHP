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
    <form action="register.php" method="$_POST">
        Enter Username: <input type="text" name="username" required="required"><br>
        Enter Password: <input type="password" name="password" required="required"><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>