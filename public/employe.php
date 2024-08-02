<?php
    session_start();
    require __DIR__.'/../inc/func_employe.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Employe.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/employe.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/employe.php';
        header('Location: employe.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';