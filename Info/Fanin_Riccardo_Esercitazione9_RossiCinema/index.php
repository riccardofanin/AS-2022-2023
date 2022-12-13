<?php

session_start();

$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '':
    case '/':
        if(isset($_SESSION['userID']))
        {
            require __DIR__ . '/home/home.php';
        }
        else
        {
            require __DIR__ . '/auth/login.html';
        }
        break;

    case '/home':
        require __DIR__ . '/home/home.php';
        break;
        
    case '/login':
        require __DIR__ . '/auth/login.html';
        break;

    case '/register':
        require __DIR__ . '/auth/register.html';
        break;

    case '/booking':
        require __DIR__ . '/booking/seat.php';
        break;

    case '/checkout':
        require __DIR__ . '/checkout/checkout.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}