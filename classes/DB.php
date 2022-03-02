<?php

namespace DB;

use PDO;

// Singleton to connect db.
class DB
{
  // Hold the class instance.
  private static $instance = null;
  private $conn;

  private $host;
  private $user;
  private $pass;
  private $name;
  private $driver;

  // The db connection is established in the private constructor.
  private function __construct($dbConection)
  {
    $this->host = $dbConection['host'];
    $this->user = $dbConection['user'];
    $this->pass = $dbConection['pass'];
    $this->name = $dbConection['dbname'];
    $this->driver = $dbConection['driver'];

    $this->conn = new PDO(
      "{$this->driver}:host={$this->host};
dbname={$this->name}",
      $this->user,
      $this->pass,
      array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
    );
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public static function getInstance($polje)
  {
    if (!self::$instance) {
      self::$instance = new DB($polje);
    }

    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function getUserMessages($username)
  {
    try {
      $stmt = $this->conn->prepare("SELECT text FROM messages INNER JOIN users ON messages.ownerId = users.id WHERE users.username = :username");
      $stmt->bindParam(':username', $username);
      
      $stmt->execute();


      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
  }

  public function getUsers()
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM users");
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      echo $result;
      return $stmt->fetchAll();
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      die();
    }
  }

  public function createMessage($message, $userId)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO messages (text, ownerId) VALUES (:text, :userId)");
      $stmt->bindParam(':text', $message);
      $stmt->bindParam(':userId', $userId);
      $stmt->execute();
      return header("location: ../chat.php");
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function login($username, $password){
      $users = $this->getUsers();
      foreach($users as $user){
        if($user["username"] == $username && $user["hash"] == $password){
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION["username"] = $username;
          $_SESSION["userId"] = $user["id"];
          return header("location: ../menu.php");
          
        }
        else{
          return header("location: ../login.php?message=wrong_credentials");
        }
      }
  }

  public function checkLogin(){
    if($_SESSION["loggedin"] == true){
      return true;
    }
    else{
      header("location: login.php");
    }

  }
}