<?php
session_start();

$userData = $_POST;

place_bid($userData);
function place_bid($userData)
{
    //
    $file = 'xml/auction.xml';
    include("xml.php");
    //
    $message = '';
    $success = false;

    if( empty( $userData['bid_amount'] ) )
    {
        $message = 'Bid Amount Cannot be Empty.';
    }
    elseif(!is_numeric( $userData['bid_amount'] ))
    {
        $message = 'Bid Amount not contain only numbers.';
    }
    elseif( $userData['current_bid_price'] > $userData['bid_amount'] )
    {
        $message = 'Your Bid Amount cannot be less than last bid ammount.';
    }
    else{}

    if( empty($message) )
    {
        $auth = $_SESSION['auth'];
        $itemNumber = $userData['item_id'];
        $bidderCustomerId = $auth['customer_id'];
        $currentBidPrice = $userData['bid_amount'];
        if (addLatestBidToItem($xml, $file, $itemNumber, $bidderCustomerId, $currentBidPrice, 1))
        {
            $message = "Thank you! Your bid is recorded in ShopOnline.";
        }
        else
        {
            $message = "Item not found.";
        }
    }
    
    $response = array(
        'status' => true,
        'message' => $message
    );

    echo json_encode($response);
    exit;
}
?>



