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
                    <li><a href="\">Home</a></li>
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
            <form id="loginForm" method="post" novalidate>
                <p id="msg"></p>
                <div class="title_text">
                    <h3>Login Form</h3>
                </div>
                <div class="form_link_box">
                    <div class="form_link_box_wrap login">
                        <a href="index.php" class="login_link">Login</a>
                        <a href="register.php" class="register_link">Signup</a>
                    </div>
                </div>

                <div class="field">
                    <input type="email" placeholder="Email Address" name="email">
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="pass-link">
                    <a href="#">Forgot Password</a>
                </div>
                <div class="form_btn">
                    <button type="submit">Login</button>
                </div>
                <div class="signup-link"> Not a member? <a href="register.php">Signup now</a></div>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>