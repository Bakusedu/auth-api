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

    // form validation
    if(!empty($data->email) && !empty($data->password)){

      $login->email = htmlentities(strip_tags(trim($data->email)));
      $login->password = htmlentities(strip_tags(trim($data->password)));

      $login->password = md5($login->password);

      // try to login
      if($login->login($login->email,$login->password)){
        //set response code -201 logged in successfully
        http_response_code(201);
        // report message to user
       echo json_encode(array("message" => "User authenticated successfully."));
      }
      else{
        // set response code - 400 bad request
        http_response_code(400);
        // report error message to user
        echo json_encode(array("message" => "Authentication failed."));
      }
    }
else{
  // set response code 400 - bad request
  http_response_code(400);
  // report message
  echo json_encode(array("message" => "All fields are required."));
}
