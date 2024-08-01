<?php
    session_start();
    //require __DIR__.'/../inc/func_produit.php';
    require __DIR__.'/../inc/flash.php';
    //require_once __DIR__.'/../features/Produit.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/home.php';
    } 
    require __DIR__.'/../inc/footer.php';