<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$error_message = array();
include_once '../core/init.php';

//get posted data
$data = json_decode(file_get_contents("php://input"));

//carry out authentication processes
if(!empty($data->name) && !empty($data->email) && !empty($data->password) && !empty($data->cpassword)){
  $data->name = htmlentities(strip_tags(trim($data->name)));
  $data->email = htmlentities(strip_tags(trim($data->email)));
  $data->password = htmlentities(strip_tags(trim($data->password)));
  $data->cpassword = htmlentities(strip_tags(trim($data->cpassword)));

  // if length of name is short
  if(strlen($data->name) < 6){
    $error_message[] = "true";
  }
  // check if name exists in database
  if($register->getName($data->name)){
     $error_message[] = "true";
   }
  // Check if email already exists
  if($register->getEmail($data->email)){
    $error_message[] = "true";
  }
  // Check if the email is Valid
  if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    $error_message[] = "true";
  }
  // check if passwords match
  if ($data->password !== $data->cpassword){
    $error_message[] = "true";
  }
  // if length of password is short
  if(strlen($data->password) < 4){
    $error_message[] = "true";
  }
  // if there are no errors,continue processing
  if(empty($error_message)){
    $register->name = $data->name;
    $register->email = $data->email;
    $register->password = md5($data->password);
    $register->profile_id = rand(1000000,2000000);

    //insert into database
    if($register->create()){
      //set response code -201 created
      http_response_code(201);
      // report message to user
      echo json_encode(array("message" => "Record Created."));
    }
    else{//if unable to create record
      // set response code - 503 service unavailable
      http_response_code(503);
      //report message to user
      echo json_encode(array("message" => "Query failed."));
    }
  }
  else{
    // set response code 400 - bad request
    http_response_code(400);
    echo json_encode(array("message" => "data authentication error."));
  }
}
else{
  // set response code 400 - bad request
  http_response_code(400);
  // report message
  echo json_encode(array("message" => "Incomplete data."));
}

 ?>
