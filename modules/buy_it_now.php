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

    $auth = $_SESSION['auth'];
    $itemNumber = $_POST["item_id"];
    $bidderCustomerId = $auth['customer_id'];
    $currentBidPrice = 0;
    if (addLatestBidToItem($xml, $file, $itemNumber, $bidderCustomerId, $currentBidPrice, 0))
    {
        $message = "Thank you! Your bid is recorded in ShopOnline.";
        $success = true;
    }
    else
    {
        $message = "Item not found.";
    }
    
    $response = array(
        'status' => true,
        'message' => $message
    );

    echo json_encode($response);
    exit;
}
?>



