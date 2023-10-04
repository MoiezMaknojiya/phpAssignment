<?php
define('tableName', 'users');

$userData = $_POST;

register_user($userData);

function register_user($userData)
{
    //
    $file = 'xml/customer.xml';
    if (!file_exists($file))
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><users></users>');
        $xml->asXML($file);
    }
    include("xml.php");
    //
    $email_regex = '/^[\w.%+-]+@(?:[\w-]+\.)+[a-zA-Z]{2,}$/';
    $userData['email'] = strtolower($userData['email']);
    //
    $firstname  = $userData['firstname'];
    $surename   = $userData['surename'];
    $email      = $userData['email'];
    $password   = $userData['password']; 
    $cpassword   = $userData['cpassword'];
    //
    $message = '';
    $success = false;

    $hasUser = hasUser($xml, $email);

    if( empty( $firstname ) )
    {
        $message = 'First Name Cannot be Empty.';
    }

    elseif( empty( $surename ) )
    {
        $message = 'Surename Cannot be Empty.';
    }

    elseif( empty( $email ) )
    {
        $message = 'Email Cannot be Empty.';
    }

    elseif (!preg_match($email_regex, $email))
    {
        $message = "Invalid Email Address.";
    }
    
    elseif($hasUser)
    {
        $message = 'User Already Exist.';
    }

    elseif( empty( $password ) )
    {
        $message = 'Password Cannot be Empty.';
    }

    elseif( empty( $cpassword ) )
    {
        $message = 'Confirm Password Cannot be Empty.';
    }

    elseif( $password !== $cpassword )
    {
        $message = 'Confirm Password Not Match.';
    }
    else{}

    if( empty($message) )
    {
        // Create a new user
        $success = createUser($xml, $file, $userData);
        $message = 'Successfully Registered!';
    }
    
    $response = array(
        'status' => $success,
        'message' => $message
    );

    echo json_encode($response);
}