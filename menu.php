<?php

    require_once 'core/init.php';

    use Config\Config;
    use DB\DB;
    
    $bazaSingleton = DB::getInstance(Config::get('baza'));
    
    $bazaSingleton->checkLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    Pozdrav <?php echo $_SESSION["username"] ?>
    <br>
    <br>
    <a href="./chat.php">Pricaj sam sa sobom</a>
</body>
</html>