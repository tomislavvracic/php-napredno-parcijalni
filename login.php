<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="/controllers/Login.php" method="post" >
        Username : <input type="text" name="username">
        Password : <input type="password" name="password">
        <input type="submit" value="login">
    </form>
    <?php
        if(isset($_GET["message"])){
            echo $_GET["message"];
        }
    ?>
</body>
</html>