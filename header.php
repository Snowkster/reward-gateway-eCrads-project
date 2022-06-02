<?php
    session_start();
?>
<!DOVTYPE html>
<html lang="en" dir="ltr">
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta charset="utf-8">
        <title>eCards</title>
    </head>

    <body>
        <nav>
            <div calss="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="eCards.php">eCards</a></li>
                    <?php
                        if (isset($_SESSION["userid"])) {
                            echo "<li><a href='profile.php'>Profile</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                        }
                        else{
                            echo"<li><a href='signup.php'>Sign up</a></li>";
                            echo "<li><a href='login.php'>Log in</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>