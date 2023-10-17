<?php
    session_start();
    $auth = !empty( $_SESSION['auth'] ) ? $_SESSION['auth'] : [];
    if( !empty( $auth ) )
    {
        header("Location: listing.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
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
    
    <hr>

    <section class="register_wrap">
        <div class="register">
            <form id="registerForm" method="post" novalidate>
                <p id="msg"></p>
                <div class="title_text">
                    <h3>Signup Form</h3>
                </div>
                <div class="form_link_box">
                    <div class="form_link_box_wrap register">
                        <a href="index.php" class="login_link">Login</a>
                        <a href="register.php" class="register_link">Signup</a>
                    </div>
                </div>
                <div class="field">
                    <input type="text"  placeholder="First Name" name="firstname">
                </div>
                <div class="field">
                    <input type="text"  placeholder="Surename" name="surename">
                </div>
                <div class="field">
                    <input type="email"  placeholder="Email Address" name="email">
                </div>
                <div class="field">
                    <input type="password"  placeholder="Password" name="password">
                </div>
                <div class="field">
                    <input type="password"  placeholder="Confirm Password" name="cpassword">
                </div>

                <div class="form_btn register_form_btn">
                    <button type="submit">Register</button>
                    <button type="button">Reset</button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/register.js"></script>
</body>
</html>