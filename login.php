<?php
    include_once 'header.php';
?>
    <section className="signup-form">
        <h2>Login</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Login</button>
            <button type="button">Login with Facebook</button>
        </form>
        <p><a href="signup.php">You don't have account, lets register!</a></p>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo"<p>Fill all fields!</p>";
            }
            else if ($_GET["error"] == "wronglogin") {
                echo"<p>Wrong username or password!</p>";
            }
            header("location: ../login.php");
            exit();
        }
        ?>

    </section>

    

<?php
    include_once 'footer.php';
?>