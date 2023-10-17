<?php
$xml = simplexml_load_file($file);

function createUser($xml, $file, $userData, $parent, $child)
{
    try
    {
        $increment = 0;
        foreach ($xml->$parent as $item)
        {
            $currentId = intval($item->$child);
            if ($currentId > $increment)
            {
                $increment = $currentId;
            }
        }
        $customer_id = $increment + 1;
        //
        $row = $xml->addChild($parent);
        //
        $row->addChild($child, $customer_id);
        //
        if( !empty( count($userData) ) )
        {
            foreach($userData as $key => $value)
            {
                $row->addChild($key, $value);
            }
        }
        $xml->asXML($file);
        return $customer_id;
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



function addLatestBidToItem($xml, $file, $item_id, $customer_id, $current_bid_price, $type)
{
    $itemToUpdate = null;
    $buy_price = 0;
    foreach ($xml->item as $item)
    {
        if (intval($item->item_id) === intval($item_id))
        {
            $itemToUpdate = $item;
            if( empty( $type ) )
            {
                $buy_price = $item->buy_it_now_price;
                $item->status = "sold";
            }
            break;
        }
    }
    if ($itemToUpdate === null)
    {
        return false;
    }
    // Create a new <latestBid> element
    $latestBid = $itemToUpdate->addChild('latest_bid');
    $latestBid->addChild('customer_id', $customer_id);

    if( empty( $type ) )
    {
        $latestBid->addChild('current_bid_price', $buy_price);
    }
    else
    {
        $latestBid->addChild('current_bid_price', $current_bid_price);
    }
    
    // Save the updated XML back to the file
    $xml->asXML($file);
    return true;
}





function remainingDateTime($duration)
{
    $timestamp = strtotime($duration);
    $targetTimestamp = $timestamp + (6 * 24 * 60 * 60) + (41 * 60 * 60) + (23 * 60) + 32;                       

    $currentTime = time();
    $remainingSeconds = $targetTimestamp - $currentTime;

    $days = floor($remainingSeconds / (24 * 60 * 60));
    $remainingSeconds -= $days * (24 * 60 * 60);
    $hours = floor($remainingSeconds / (60 * 60));
    $remainingSeconds -= $hours * (60 * 60);
    $minutes = floor($remainingSeconds / 60);
    $seconds = $remainingSeconds % 60;

    return "$days Days $hours Hours $minutes Minutes $seconds Seconds Remaining.";
}

function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}


