<?php

process_auction_items();
function process_auction_items()
{
    //
    $file = 'xml/auction.xml';
    include("xml.php");
    //
    $success = false;

    $currentDateTime = new DateTime();

    foreach ($xml->item as $item)
    {
        $status = (string)$item->status;
        $endDate = new DateTime((string)$item->end_date . ' ' . (string)$item->end_time);

        if ($status == "in_progress" && $currentDateTime >= $endDate)
        {
            $currentBidPrice = (float)$item->latest_bid[count($item->latest_bid) - 1]->current_bid_price;
            $reservePrice = (float)$item->reserve_price;

            $newStatus = ($currentBidPrice >= $reservePrice) ? "sold" : "failed";

            $item->status = $newStatus;
        }
    }
    $updatedXmlString = $xml->asXML($file);
    
    $response = array(
        'status' => true,
        'message' => "Processing is complete."
    );

    echo json_encode($response);
    exit;
}
?>



