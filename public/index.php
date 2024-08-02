<?php
    session_start();
    require __DIR__.'/../inc/func_index.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/User.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $users = new User();
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/index.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/index.php';
        header('Location: index.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';