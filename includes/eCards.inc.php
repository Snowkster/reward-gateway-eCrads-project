<?php
include_once 'dbh.inc.php';
        $get_user = "SELECT * FROM users";
        $run_user = mysqli_query($conn, $get_user);
        $row = mysqli_fetch_array($run_user);

        $role = $row['role'];