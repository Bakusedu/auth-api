<?php
  class Login {
    private $database;
    public $name,$email,$password;

    public function __construct(){
      $this->database = new Connect();
      $this->database=$this->database->connection();
    }

    //class methods
    public function login(){
      $statement = $this->database->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
      $result = $statement->execute(array("email" => $this->email, "password" => $this->password));
      $result = $statement->fetch();
      return $result ? true : false;
    }

  }
