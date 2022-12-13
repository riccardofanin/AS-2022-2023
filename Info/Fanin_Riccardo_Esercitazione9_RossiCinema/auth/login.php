<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connect.php';

function login_user()
{
    global $db;

    $identifier = $_POST['identifier'];
    $pwd = $_POST['password'];

    if(filter_var($identifier, FILTER_VALIDATE_EMAIL))
    {
        $sql = "SELECT * from user where email='". $identifier ."'";
        $result = $db->query($sql)->fetch();
    }
    else
    {
        $sql = "SELECT * from user where username='". $identifier ."'";
        $result = $db->query($sql)->fetch();
    }
    
    if(!$result){
        http_response_code(400);
        echo 'User not found';
        exit();
    }


    if ($result['pwd'] == $pwd){
        $_SESSION['userID'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        http_response_code(200);
        ob_start();
        header('Location: ../home/home.php');
        exit();
    }
    else{
        http_response_code(400);
        ob_start();
        echo 'Wrong password';
        exit();
    }
}

if($_POST['submit'])
{
    login_user();
}
