<?php
session_start();

spl_autoload_register(function ($class) {
  $parts = explode('\\', $class);
  include_once __DIR__ . '/../classes/' . end($parts) . '.php';
});
