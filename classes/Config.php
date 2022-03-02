<?php

namespace Config;

class Config
{
  private function __construct()
  {
  }

  public static function get($file = '')
  {
    if ($file) {
      $polje = require __DIR__ . '/../config/' . $file . '.php';
      return $polje;
    }

    return false;
  }
}
