<?php
$xml = simplexml_load_file($file);
function createUser($xml, $file, $userData)
{
    try
    {
        $increment = 0;
        foreach ($xml->user as $user)
        {
            $currentId = intval($user['id']);
            if ($currentId > $increment)
            {
                $increment = $currentId;
            }
        }
        $customer_id = $increment + 1;

        $user = $xml->addChild('user');

        $user->addChild('customer_id', $customer_id);
        //
        if( !empty( count($userData) ) )
        {
            foreach($userData as $key => $value)
            {
                $user->addChild($key, $value);
            } unset($row);
        }
        $xml->asXML($file);
        return true;
    }
    catch (Exception $e)
    {
        return false;
    }
}


function readUser($xml, $id = null)
{
    if ($id)
    {
        foreach ($xml->user as $user)
        {
            if ($user['id'] == $id)
            {
                return $user;
            }
        }
        return null;
    }
    return $xml;
}


function hasUser($xml, $email = null)
{
    if ($email)
    {
        foreach ($xml->user as $user)
        {
            if (strcasecmp($user->email, $email) == 0)
            {
                return true;
            }
        }
        return false;
    }
}


function checkAuth($xml, $email, $password)
{
    if ($email && $password)
    {
        foreach ($xml->user as $user)
        {
            if ($user->email == $email && $user->password == $password)
            {
                return json_decode(json_encode($user), true);
            }
        }
    }
    return [];
}


function updateUser($xml, $file, $id, $name = null, $email = null)
{
    foreach ($xml->user as $user)
    {
        if ($user['id'] == $id)
        {
            if ($name) $user->name = $name;
            if ($email) $user->email = $email;
            $xml->asXML($file);
            return true;
        }
    }
    return false;
}


function deleteUser($xml, $file, $id)
{
    $index = 0;
    foreach ($xml->user as $user)
    {
        if ($user['id'] == $id)
        {
            unset($xml->user[$index]);
            $xml->asXML($file);
            return true;
        }
        $index++;
    }
    return false;
}