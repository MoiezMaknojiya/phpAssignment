<?php
    session_start();
    $auth = !empty( $_SESSION['auth'] ) ? $_SESSION['auth'] : [];
    if( empty($auth) )
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main Style -->
      <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <header>
       <div class="title">
            <h2>Shope Online</h2>
        </div>
        <nav>
            <ul>
                <?php if( empty( $auth ) ) { ?>
                    <li><a href="index.php">Home</a></li>
                <?php } ?>
                <?php if( !empty( $auth ) ) { ?>
                    <li><a href="listing.php">Listing</a></li>
                    <li><a href="bidding.php">Bidding</a></li>
                    <li><a href="maintenance.php">Maintenance</a></li>
                    <li><a href="modules/logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    
    <div class="admin_title">
        <h3><?php echo $auth['firstname']; ?></h3>
    </div>

    <hr>

    <section class="bidding_wrap">
        <div class="bidding">
            <h4>Current auction items are listed below. To place a bid for an item, use the Place Bid button. NOTE: Item remaining time and bid prices are updated every 5 seconds.</h4>
            <div class="bidding_list">
                <ul class="bids">
                </ul>
            </div>
        </div>
    </section>


    <div id="bid_popup" class="bid_popup">
        <div class="bid_popup_wrap_close"></div>
        <div class="bid_popup_content">
            <div class="bid_popup_content_close">X</div>
            <div class="bid_popup_box">
                <div class="form_txt">
                    <form id="placeBidForm" method="post" novalidate>
                        <input type="hidden" class="item_id" placeholder="item_id" name="item_id" value="">
                        <input type="hidden" class="current_bid_price" placeholder="current_bid_price" name="current_bid_price" value="">
                        <p id="msg"></p>
                        <div class="field">
                            <input type="text" placeholder="Bid Amount" name="bid_amount">
                        </div>
                        <div class="form_btn">
                            <button type="submit">Place Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/bidding.js"></script>
</body>
</html>