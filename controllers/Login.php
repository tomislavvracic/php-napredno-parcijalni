<?php

require_once '../core/init.php';

use Config\Config;
use DB\DB;

if(isset($_POST)){
    $bazaSingleton = DB::getInstance(Config::get('baza'));

    $username = $_POST["username"];
    $password = $_POST["password"];

    $bazaSingleton->login($username,$password);
}