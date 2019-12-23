<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function(Request $request, Response $response, array $args){

    return $response->write("Hello!");
});

//insert_user function
$app->post('/insert_user', function (Request $request, Response $response, array $args) {

    //get request parameters
    $user_details = $request->getParsedBody();

    if(!isset($user_details)){ return $response->write("Users details are undefined!");}

    $name = filter_var($user_details['name'],FILTER_SANITIZE_STRING);
    $email = filter_var($user_details['email'],FILTER_VALIDATE_EMAIL);
    $password = filter_var($user_details['password'],FILTER_SANITIZE_STRING);

    if($name == false){
        return $response->write("Name is undefined!");
    }

    if($email == false){
        return $response->write("Email is undefined or not valid!");
    }

    if($password == false){
        return $response->write("Password is undefined!");
    }

    $password_encripted = hash('sha256',$password);

    $user_model = new Model\Users($this->db);

    $user_id = $user_model->insertUser($name,$email,$password_encripted);

    //check if results received
    if($user_id == false) { return $response->write("User was not inserted");}
     
    $result['user_id'] = $user_id;

    return  $response->withJson($result);

}); //$app->post('/check_inventory'

//get all users
$app->get('/users', function (Request $request, Response $response, array $args) {

    $users_model = new Model\Users($this->db);

    $users = $users_model->getUsers();

    if(!isset($users) || empty($users)) { $response->write("Users not defined!"); }

    return  $response->withJSON($users); 

}); //$app->get('/users'

