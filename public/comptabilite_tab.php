<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/func_comptabilite.php';
    require_once __DIR__.'/../features/Comptabilite.php';
    require_once __DIR__.'/../features/TypeTrie.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
    $type_trie = new TypeTrie();
    $array_of_type_trie = $type_trie->read($_GET['q']);
    $comptabilite = new Comptabilite();
    $default_array = $comptabilite->read($_GET['q']);
    $total = array_reduce(
        $default_array,
        function ($prev, $item) {
            return $prev + $item['montant'];
        }
    );
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/comptabilite_tab.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/comptabilite_tab.php';
    }
    require __DIR__.'/../inc/footer.php';