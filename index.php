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
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if( empty( $auth ) ) { ?>
                    <li><a href="index.php">Home</a></li>
                <?php } ?>
                <?php if( !empty( $auth ) ) { ?>
                    <li><a href="listing.php">Listing</a></li>
                    <li><a href="#contact">Bidding</a></li>
                    <li><a href="#about">Maintenance</a></li>
                    <li><a href="modules/logout.php">Logout</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>

    <hr>

    <section class="register_wrap">
        <div class="heading">
            <p>Please login below or to register as a new user. <a href="register.php">Register Here.</a></p>
        </div>
        <div class="register">
            <form id="loginForm" method="post" novalidate>
                <p id="msg"></p>
                <fieldset>
                    <legend>Login Details</legend>
                    <div >
                        <input type="email" placeholder="Email Address" name="email">
                    </div>
                    <div >
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <button type="submit">Login</button>
                </fieldset>
            </form>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>