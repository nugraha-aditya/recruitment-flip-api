<?php
namespace Config;

class DBConnection {

  public $config;
  private $db_connection;
  private $host;
  private $port;
  private $database;
  private $db_username;
  private $db_password;
  public $connection;
  private $enter = "\r\n";

  public function __construct(){
    $this->connection = null;
    $this->config = parse_ini_file('config.ini');
    $this->db_connection = $this->config['db_connection'];
    $this->host = $this->config['db_host'];
    $this->port = $this->config['db_port'];
    $this->database = $this->config['db_database'];
    $this->db_username = $this->config['db_username'];
    $this->db_password = $this->config['db_password'];
  }

  public function getConnection() {
    $this->connection = null;

    // echo "......".$this->enter;
    // echo "......".$this->enter;
    // echo "Checking localhost connection....".$this->enter;
    // echo "================================== ".$this->enter;
    // echo "DB connection : ".$this->connection."".$this->enter;
    // echo "DB host : ".$this->host."".$this->enter;
    // echo "DB port : ".$this->port."".$this->enter;
    // echo "================================== ".$this->enter;
    // echo "......".$this->enter;
    // echo "......".$this->enter;

    //Checking connection
    $this->connection = mysqli_connect($this->host, $this->db_username, $this->db_password, $this->database);
    if (!$this->connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
      //echo "Successfully connected".$this->enter;
    }
    // echo "......".$this->enter;
    // echo "......".$this->enter;

    return $this->connection;

  }

  public function setDB() {

    $this->connection = null;

    echo "......".$this->enter;
    echo "......".$this->enter;
    echo "Checking localhost connection....".$this->enter;
    echo "================================== ".$this->enter;
    echo "DB connection : ".$this->connection."".$this->enter;
    echo "DB host : ".$this->host."".$this->enter;
    echo "DB port : ".$this->port."".$this->enter;
    echo "================================== ".$this->enter;
    echo "......".$this->enter;
    echo "......".$this->enter;

    //Checking connection
    $this->connection = mysqli_connect($this->host, $this->db_username, $this->db_password);
    if (!$this->connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
      echo "Successfully connected".$this->enter;
    }

    $sql = "CREATE DATABASE IF NOT EXISTS ".$this->database;
    echo "Create Database with name ".$this->database." ....".$this->enter;
    if (mysqli_query($this->connection, $sql)) {
        echo "Database created successfully".$this->senter;
    } else {
        echo "Error creating database: " . mysqli_error($this->connection);
        mysqli_close($this->connection);
        die();
    }

  }

}


 ?>
