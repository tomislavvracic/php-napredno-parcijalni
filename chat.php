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
    <title>Document</title>
</head>
<body>
    <?php

        $messages = $bazaSingleton->getUserMessages($_SESSION["username"]);
        $counter = 0;
        foreach($messages as $message){
            $counter++;
            echo "[" . $counter . "] -> " . $message["text"] . "<br>"; 
        }
    ?>

    <form action="./controllers/NewMessage.php" method="post">
        <input type="text" name="message">
        <input type="text" name="userId" value=<?php echo $_SESSION["userId"]?> style="display:none">
        <input type="submit" value="posalji si poruku">
    </form>
</body>
</html>