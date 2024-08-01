<?php
    session_start();
    //require __DIR__.'/../inc/func_user.php';
    require __DIR__.'/../inc/flash.php';
    //require_once __DIR__.'/../features/User.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        logout();
    }
    require __DIR__.'/../inc/footer.php';