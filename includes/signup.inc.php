<?php

if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $eamil = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $eamil, $username, $pwd, $pwdRepeat) !== false) {

        header("location: ../signup.php?error=emptyinput");
        exit();

    }

    if (invalidUid($username) !== false) {

        header("location: ../signup.php?error=invaliduid");
        exit();

    }

    if (invalidEmail($eamil) !== false) {

        header("location: ../signup.php?error=invalidemail");
        exit();

    }

    if (pwdMach($pwd, $pwdRepeat) !== false) {

        header("location: ../signup.php?error=passworddontmatch");
        exit();

    }

    if (uidExists($conn, $username, $eamil) !== false) {

        header("location: ../signup.php?error=usernametaken");
        exit();

    }

    createUser($conn, $name, $eamil, $username, $pwd);


    }
    else {
        header("location: ../signup.php");
        exit();
    }