<?php
    session_start();
    require __DIR__.'/../inc/func_comptabilite.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Comptabilite.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/comptabilite.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/comptabilite.php';
    }
    require __DIR__.'/../inc/footer.php';