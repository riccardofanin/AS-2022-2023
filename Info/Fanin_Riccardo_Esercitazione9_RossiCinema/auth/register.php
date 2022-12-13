<?php
ob_start();
require_once 'db_connect.php';

function register_user()
{
    global $db;

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $conf_pwd = $_POST['confirm-password'];

    $query = "INSERT INTO user (username, email, pwd) VALUES ('$username', '$email', '$pwd')";
    $result = $db->query($query);
    
    if($result){
        http_response_code(201);
        $_SESSION['userID'] = $db->lastInsertId();
        $_SESSION['email'] = $email;
        
    }   
    else{
        http_response_code(400);
        echo 'failed to register';
    }
}

if(isset($_POST["submit"]))
{
    register_user();    

    exit;
}
