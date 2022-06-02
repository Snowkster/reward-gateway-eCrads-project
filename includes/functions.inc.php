<?php


function emptyInputSignup($name, $eamil, $username, $pwd, $pwdRepeat){
    global $results;
    if (empty($name) || empty($eamil) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $results = true;
    }else{
        $results = false;
    }

    return $results;
}//Check for empty fields.

function invalidUid($username){

    if (!preg_match('/^[A-Za-z0-9]+$/', $username)) {
        $results = true;
    } else {
        $results = false;
    }

    return $results;
}//Check for valid username.

function invalidEmail($eamil){

    if (!filter_var($eamil, FILTER_VALIDATE_EMAIL)) {
        $results = true;
    } else {
        $results = false;
    }

    return $results;
}//Check for valid Email.

function pwdMach($pwd, $pwdRepeat){

    if ($pwd !== $pwdRepeat) {
        $results = true;
    } else {
        $results = false;
    }

    return $results;
}//Check the passwords are the same.

function uidExists($conn, $username, $email){

    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        
        header("location: ../signup.php?error=stmtfaild");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {

        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}//Check for exiating users.

function createUser($conn, $name, $email, $username, $pwd){
    
    $sql = "INSERT INTO users (username, userEmail, userUid, userPwd, role) VALUES(?, ?, ?, ?, 'user');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        
        header("location: ../signup.php?error=stmtfaild");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
}//Create users.

function emptyInputLogin( $username, $pwd){
    global $results;
    if (empty($username) || empty($pwd)) {
        $results = true;
    }else{
        $results = false;
    }

    return $results;
}

function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $pwd);

    if ($uidExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["userPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true) {
        session_start();
        $_SESSION["userid"] = $uidExists["userId"];
        $_SESSION["userid"] = $uidExists["userUid"];
        header("location: ../index.php");
        exit();
    }
}
