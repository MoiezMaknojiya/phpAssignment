<?php

process_auction_items();
function process_auction_items()
{
    $html = '';
    //
    $file = 'xml/auction.xml';
    
    include("xml.php");
  
    // Initialize variables to store the sold and failed items and revenue
    $soldItems = [];
    $failedItems = [];
    $totalRevenue = 0;

    // Iterate through each item in the XML
    foreach ($xml->item as $item) {
        $status = (string) $item->status;
        $description = (string) $item->item_name;

        if ($status === 'sold') {
            $currentBidPrice = (float) $item->latest_bid[count($item->latest_bid) - 1]->current_bid_price;
            $revenue = $currentBidPrice * 0.03; // 3% of sold price
            $soldItems[] = [
                'Item ID' => (int) $item->item_id,
                'Item Name' => $description,
                'Sold Price' => $currentBidPrice,
            ];
            $totalRevenue += $revenue;
        } elseif ($status === 'failed') {
            $reservePrice = (float) $item->reserve_price;
            $revenue = $reservePrice * 0.01; // 1% of reserved price
            $failedItems[] = [
                'Item ID' => (int) $item->item_id,
                'Item Name' => $description,
                'Reserved Price' => $reservePrice,
            ];
            $totalRevenue += $revenue;
        }
    }

    // Remove sold and failed items from the XML
    foreach ($soldItems as $soldItem) {
        foreach ($xml->item as $item) {
            if ((int) $item->item_id === $soldItem['Item ID']) {
                $node = dom_import_simplexml($item);
                $node->parentNode->removeChild($node);
                break;
            }
        }
    }

    foreach ($failedItems as $failedItem) {
        foreach ($xml->item as $item) {
            if ((int) $item->item_id === $failedItem['Item ID']) {
                $node = dom_import_simplexml($item);
                $node->parentNode->removeChild($node);
                break;
            }
        }
    }

    // Save the modified XML
    $xml->asXML('your_auction_data.xml');

    // Display the results
    $html.='<h2>Sold and Failed Items</h2>';
    $html.='<table border="1"><tr><th>Item ID</th><th>Item Name</th><th>Sold Price / Reserved Price</th></tr>';
    foreach ($soldItems as $item) {
        $html.='<tr><td>' . $item['Item ID'] . '</td><td>' . $item['Item Name'] . '</td><td>' . $item['Sold Price'] . '</td></tr>';
    }
    foreach ($failedItems as $item) {
        $html.='<tr><td>' . $item['Item ID'] . '</td><td>' . $item['Item Name'] . '</td><td>' . $item['Reserved Price'] . '</td></tr>';
    }
    $html.='</table>';

    $html.='<h2>Total Sold Items: ' . count($soldItems) . '</h2>';
    $html.='<h2>Total Failed Items: ' . count($failedItems) . '</h2>';
    $html.='<h2>Total Revenue: ' . $totalRevenue . '</h2>';

    $response = array(
        'status' => true,
        'html' => $html
    );

    echo json_encode($response);
    exit;
}
?>



