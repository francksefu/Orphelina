<?php
    session_start();
    require __DIR__.'/../inc/func_typetrie.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/TypeTrie.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/type_trie.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/type_trie.php';
        header('Location: type_trie.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';