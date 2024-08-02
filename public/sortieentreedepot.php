<?php
    session_start();
    require __DIR__.'/../inc/func_sortieentreedepot.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/SortieEntreeDepot.php';
    require_once __DIR__.'/../features/Produit.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $produit = new Produit();
    $array_of_product = $produit->read();
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/sortieentreedepot.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/sortieentreedepot.php';
        header('Location: sortieentreedepot.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';