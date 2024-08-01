<?php
    session_start();
    require __DIR__.'/../inc/func_comptabilite.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Comptabilite.php';
    require_once __DIR__.'/../features/TypeTrie.php';
    require __DIR__.'/../inc/header.php';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $type_trie = new TypeTrie();
    $array_of_type_trie = $type_trie->read($_GET['q']);
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/comptabilite.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/comptabilite.php';
        header("Location: comptabilite.php?q=".$_GET['q']."", true, 303);
    
    }
    require __DIR__.'/../inc/footer.php';