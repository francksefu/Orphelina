<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/func_typetrie.php';
    require_once __DIR__.'/../features/TypeTrie.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $type_trie = new TypeTrie();
    $default_array = $type_trie->read();
    $total = count($default_array);
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/type_trie_tab.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/type_trie_tab.php';
        header('Location: type_trie_tab.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';