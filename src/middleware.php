<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

//Authentication token
//https://github.com/dyorg/slim-token-authentication
//https://packagist.org/packages/dyorg/slim-token-authentication

//for Authentication token
include 'UnauthorizedException.php';
use Slim\Middleware\TokenAuthentication;

//define token from settings
define('PASSWORD', $settings['settings']['token']);

//Authentication function
$authenticator = function($request, TokenAuthentication $tokenAuth) {
    
    //  Try find authorization token via header, parameters, cookie or attribute
    //  If token not found, return response with status 401 (unauthorized)
    
    $token = $tokenAuth->findToken($request);

    if($token != PASSWORD){
        throw new UnauthorizedException('Invalid Token');
    }

}; //$authenticator = function($request, TokenAuthentication $tokenAuth) {
 
/**
 * Add token authentication middleware
 */
 $app->add(new TokenAuthentication([

    'path' => ['/users','/insert_user'], //[] - all routes that need authentication must be inserted there
    'passthrough' => [],//all routes that will not pass Authentication need to add here
    'authenticator' => $authenticator,
    'secure' => false
 
]));
