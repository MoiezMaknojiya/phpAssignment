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

    <section class="register_wrap">
        <div class="register">
            <form id="listingForm" method="post" novalidate>
                <input type="hidden" value="<?php echo $auth['customer_id']?>" name="customer_id">
                <p id="msg"></p>
                <div class="field">
                    <input type="text"  placeholder="Item Name" name="item_name">
                </div>
                <div class="field">
                    <?php
                        $xmlFile = 'modules/xml/auction.xml';
                        //
                        $xml = simplexml_load_file($xmlFile);
                        //
                        $categories = ['Laptop', "Drones"];
                        //
                        foreach ($xml->item as $item)
                        {
                            $category = (string)$item->category;
                            if (!in_array($category, $categories))
                            {
                                $categories[] = $category;
                            }
                        }
                    ?>
                    <select name="category" id="categories">
                        <option value="">Select Category</option>
                        <?php
                            foreach ($categories as $category)
                            {
                                echo '<option value="' . $category . '">' . $category . '</option>';
                            }
                        ?>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="field other_category_field" style="display: none;">
                    <input type="text" placeholder="Other Category" name="other_category">
                </div>
                <div class="field">
                    <input type="number" placeholder="Start Price" name="start_price">
                </div>
                <div class="field">
                    <input type="number" placeholder="Reserve Price" name="reserve_price">
                </div>
                <div class="field">
                    <input type="number" placeholder="Buy It Now Price" name="buy_it_now_price">
                </div>
                <div class="field">
                    <input type="datetime-local" name="duration">
                </div>
                <div class="field">
                    <textarea id="description" rows="4" cols="50" name="description"></textarea>
                </div>
                <div class="form_btn register_form_btn">
                    <button type="submit">Listing</button>
                    <button type="button">Reset</button>
                </div>
            </form>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/listing.js"></script>
</body>
</html>