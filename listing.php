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
    
    <h3><?php echo $auth['firstname']; ?></h3>

    <hr>

    <section class="register_wrap">
        <div class="register">
            <form id="registerForm" method="post" novalidate>
                <p id="msg"></p>
                <fieldset>
                    <legend>Registration Details</legend>
                    <div>
                        <input type="text"  placeholder="First Name" name="firstname">
                    </div>
                    
                    <div>
                        <input type="text"  placeholder="Surename" name="surename">
                    </div>
                    
                    <div>
                        <input type="email"  placeholder="Email Address" name="email">
                    </div>
                    
                    <div>
                        <input type="password"  placeholder="Password" name="password">
                    </div>
                    
                    <div>
                        <input type="password"  placeholder="Confirm Password" name="cpassword">
                    </div>

                    <button type="submit">Register</button>
                    <button type="button">Reset</button>
                </fieldset>
            </form>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/listing.js"></script>
</body>
</html>