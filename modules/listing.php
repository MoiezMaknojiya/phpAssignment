<?php
$userData = $_POST;

register_user($userData);

function register_user($userData)
{
    //
    $file = 'xml/auction.xml';
    if (!file_exists($file))
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><auction></auction>');
        $xml->asXML($file);
    }
    include("xml.php");
    //
    $userData['start_date'] = date('Y-m-d');
    $userData['start_time'] = date('h:i A');
    $start_duration = date('Y-m-d h:i A');
    //
    $end_duration = $userData['duration'];
    $userData['end_date'] = date('Y-m-d', strtotime($end_duration));
    $userData['end_time'] = date('h:i A', strtotime($end_duration));
    //
    $userData['status'] = "in_progress";
    //
    $message = '';
    $success = false;

    if( empty( $userData['item_name'] ) )
    {
        $message = 'Item Name Cannot be Empty.';
    }
    elseif( empty( $userData['category'] ) )
    {
        $message = 'Category Cannot be Empty.';
    }
    elseif($userData['category'] == "other" && empty( $userData['other_category'] ) )
    {
        $message = 'Other Category Name Cannot be Empty.';
    }
    //----------------------------------------------------------
    elseif( empty( $userData['start_price'] ) )
    {
        $message = 'Start Price Cannot be Empty.';
    }
    elseif( empty( $userData['reserve_price'] ) )
    {
        $message = 'Reserve Price Cannot be Empty.';
    }
    elseif( $userData['start_price'] > $userData['reserve_price'] )
    {
        $message = 'Start Price Cannot be More Than Reserve Price.';
    }
    elseif( empty( $userData['buy_it_now_price'] ) )
    {
        $message = 'Buy it now Price Cannot be Empty.';
    }
    elseif( $userData['reserve_price'] > $userData['buy_it_now_price'] )
    {
        $message = 'Reserve Price Cannot be More Than But It Now Price.';
    }
    elseif( empty( $userData['duration'] ) )
    {
        $message = 'Duration Cannot be Empty.';
    }
    //----------------------------------------------------------
    elseif( strtotime( $start_duration ) > strtotime( $end_duration ) )
    {
        $message = 'Start Date Cannot Be Greate Than End Date.';
    }
    //----------------------------------------------------------
    else{}
    if( empty($message) )
    {
        $userData['category'] = !empty($userData['category'] == "other") ? $userData['other_category'] : $userData['category'];
        unset($userData['other_category']);
        // Create a Auction Item
        $id = createUser($xml, $file, $userData, "item", "item_id");
        $success = ( !empty($id) ) ? true : false;
        $message = "Thank you! Your item has been listed in ShopOnline. The item number is {$id}, and the bidding starts now: {$userData['start_date']} on {$userData['end_date']}";
    }
    
    $response = array(
        'status' => $success,
        'message' => $message
    );

    echo json_encode($response);
}