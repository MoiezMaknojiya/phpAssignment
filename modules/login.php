<?php

define('tableName', 'users');

$userData = $_POST;

loginUser($userData);

function loginUser($userData)
{
    $email_regex = '/^[\w.%+-]+@(?:[\w-]+\.)+[a-zA-Z]{2,}$/';
    //
    $file = 'xml/customer.xml';
    if (!file_exists($file))
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><users></users>');
        $xml->asXML($file);
    }
    include("xml.php");
    //
    $email      = $userData['email'];
    $password   = $userData['password'];
    //
    $message = '';
    $success = false;

    if( empty( $email ) )
    {
        $message = 'Email Cannot be Empty.';
    }
    elseif (!preg_match($email_regex, $email))
    {
        $message = "Invalid Email Address.";
    }
    elseif( empty( $password ) )
    {
        $message = 'Password Cannot be Empty.';
    }
    else {}

    if( empty($message) )
    {
        $auth = checkAuth($xml, $email, $password);
        //
        if( !empty( count($auth) ) )
        {
            session_start();
            $_SESSION['auth'] = $auth;
            $message = 'Successfully Login!';
            $success = true;
        }
        else
        {
            $message = 'Invalid Login Credentails!';
        }
    }

    $response = array(
        'status' => $success,
        'message' => $message
    );

    echo json_encode($response);
}