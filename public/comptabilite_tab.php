<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Comptabilite.php';
    require __DIR__.'/../inc/header.php';
    $errors = [];
    $inputs = [];
    $valid = false;
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