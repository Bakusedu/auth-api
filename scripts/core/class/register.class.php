<?php

  class Register {
      private $database;
      public $name,$email,$password,$profile_id;

      public function __construct(){
        $this->database = new Connect();
        $this->database=$this->database->connection();
      }

      //class methods
      public function create(){
        $statement = $this->database->prepare("INSERT INTO users (name,email,password,profile_id) VALUES (?,?,?,?)");
        $statement->bindParam(1,$this->name);
        $statement->bindParam(2,$this->email);
        $statement->bindParam(3,$this->password);
        $statement->bindParam(4,$this->profile_id);
        $result = $statement->execute();

        return $result ? true : false;
      }
      public function getName($name){
        $statement = $this->database->prepare("SELECT name FROM users WHERE name = :name");
        $result = $statement->execute(array("name" => $name));
        $result = $statement->fetch();
        return $result ? true : false;
      }
      public function getEmail($email){
        $statement = $this->database->prepare("SELECT email FROM users WHERE email = :email");
        $result = $statement->execute(array("email" => $email));
        $result = $statement->fetch();
        return $result ? true : false;
      }

}
