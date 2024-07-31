<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/func_sortieentreedepot.php';
    require_once __DIR__.'/../features/SortieEntreeDepot.php';
    require_once __DIR__.'/../features/Produit.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $produit = new Produit();
    $array_of_product = $produit->read();
    $sortieentreedepot = new SortieEntreeDepot();
    $default_array = $sortieentreedepot->read_group_by_facture($_GET['q']);
    $total = 0;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/sortieentreedepot_tab.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/sortieentreedepot_tab.php';
        header('Location: sortieentreedepot_tab.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';