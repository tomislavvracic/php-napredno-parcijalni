<?php

require_once '../core/init.php';

use Config\Config;
use DB\DB;

if(isset($_POST)){
    $bazaSingleton = DB::getInstance(Config::get('baza'));

    $message = $_POST["message"];
    $userId = $_POST["userId"];

    $bazaSingleton->createMessage($message,$userId);
}