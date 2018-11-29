<?php

class Connect {

  private $host = 'localhost';
  private $user = 'root';
  private $password = '';
  private $dbname = 'report';

  public function connection(){
    $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }
}
