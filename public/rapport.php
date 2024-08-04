<?php
    session_start();
    require  __DIR__.'/../inc/func_comptabilite.php';
    require  __DIR__.'/../inc/func_rapport.php';
    require  __DIR__.'/../inc/func_sortieentreedepot.php';
    require_once __DIR__.'/../features/TypeTrie.php';
    require_once __DIR__.'/../features/Comptabilite.php';
    require_once __DIR__.'/../features/Produit.php';
    require_once __DIR__.'/../features/Child.php';
    require_once __DIR__.'/../features/SortieEntreeDepot.php';
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $type_trie = new TypeTrie();
    $array_of_type_trie = $type_trie->read(null);
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/rapport.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/rapport.php';
        header('Location: rapport.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';