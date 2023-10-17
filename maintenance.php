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
        <div id="msg"></div>
        <div class="bidding">
            <div class="btn_group">
                <button type="button" class="process_auction_items">Process Auction Items</button>
                <button type="button" class="generate_report">Generate Report</button>
            </div>
        </div>
    </section>

    <div id="report_table"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/maintenance.js"></script>
</body>
</html>