<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/func_employe.php';
    require_once __DIR__.'/../features/Employe.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $employe = new Employe();
    $default_array = $employe->read();
    $total = count($default_array);
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/employe_tab.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/employe_tab.php';
        header('Location: employe_tab.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';