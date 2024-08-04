<?php
    session_start();
    require __DIR__.'/../inc/func_child.php';
    require __DIR__.'/../inc/func_traducteur.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Child.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/child.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/child.php';
        header('Location: child.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';