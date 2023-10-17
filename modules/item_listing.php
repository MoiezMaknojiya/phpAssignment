<?php
getBiddingList();
function getBiddingList()
{
    $html = "";
    //
    $file = 'xml/auction.xml';
    //
    include("xml.php");
    //
    $lists = [];
    foreach ($xml->item as $value)
    {
        $data = [];
        $data['item_id']    = $value->item_id;
        $data['category']   = $value->category;
        $data['duration']   = $value->duration;
        $data['item_name']  = $value->item_name;
        $data['buy_it_now_price']=$value->buy_it_now_price;
        //
        if( !empty($value->latest_bid) )
        {
            foreach($value->latest_bid as $bid)
            {
                $data['current_bid_price'] = $bid->current_bid_price;
            }
        }
        else
        {
            $data['current_bid_price'] = $value->start_price;
        }
        if($value->status == "in_progress")
        {
            $lists[] = $data;
        }
    }
    //
    foreach ($lists as $row)
    {
        $duration_remaining = remainingDateTime($row['duration']);
        $item_id = !empty($row['item_id']) ? $row['item_id'] : "";
        $category = !empty($row['category']) ? $row['category'] : "";
        $item_name = !empty($row['item_name']) ? $row['item_name'] : "";
        $description = !empty($row['description']) ? $row['description'] : "";
        $buy_it_now_price = !empty($row['buy_it_now_price']) ? $row['buy_it_now_price'] : "";
        $current_bid_price = !empty($row['current_bid_price']) ? $row['current_bid_price'] : "";
        $html.="
        <li>
            <div class='bid_box'>
                <span class='category_name'>{$category}</span>
                <div class='bid_detail'>
                    <h1>{$item_name}</h1>
                    <p>{$description}</p>
                    <div class='price'>
                        <div class='buy_it_now_price'>
                            <label>Buy It Now Price</label>
                            <span>{$buy_it_now_price}</span>
                        </div>
                        <div class='bid_price'>
                            <label>Bid Price</label>
                            <span>{$current_bid_price}</span>
                        </div>
                    </div>
                </div>
                <div class='expiring_note'>
                    <p>{$duration_remaining}</p>
                </div>
                <div class='btn'>
                    <button type='button' class='place_bid_btn' data-id='{$item_id}' data-amount='{$current_bid_price}' >Place Bid</button>
                    <button type='button' class='buy_it_btn'    data-id='{$item_id}'>Buy It Now</button>
                </div>
            </div>
        </li>";
    }

    $response = [
        'status' => true,
        'message' => 'Request processed successfully',
        'response' => $html,
    ];
    echo json_encode($response);
    exit;
}
?>



