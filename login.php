<?php
session_start();
include_once('connection.php');

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    echo $password; echo "\n";
    echo $username; echo "\n";
    $sql = "SELECT * FROM `tabl_user` WHERE `username`='$username' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
    echo $result; echo "\n";

    if (empty($_POST['username']) && empty($_POST['password'])) {
        echo "<script>alert('Please Fill Username and Password');</script>";
        exit;
    } 
    elseif (empty($_POST['password'])) {
        echo "<script>alert('Please Fill Password');</script>";
        exit;
    } 
    elseif (empty($_POST['username'])) {
        echo "<script>alert('Please Fill Username);</script>";
        exit;
    } 
    else {
        echo "[masuk di else awal]";
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $username = $row['username'];
            $password = $row['password'];
            echo "[masuk di if 1]";
            if (1) {
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo "<script>window.location.href='welcome.php';</script>";
                exit;
            }
            else {
                echo "<script>alert('Step 2 Invalid Username or Password');</script>";
                exit;
            }
        }
        else {
            echo "<script>alert('Invalid Username or Password');</script>";
            exit;
        }
    }

}
