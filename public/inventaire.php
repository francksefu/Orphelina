<?php
    session_start();
    require __DIR__.'/../inc/flash.php';
    require __DIR__.'/../inc/func_sortieentreedepot.php';
    require_once __DIR__.'/../features/SortieEntreeDepot.php';
    require __DIR__.'/../inc/header.php';


    $sortie_entree_depot = new SortieEntreeDepot();
    $array_inventaire = $sortie_entree_depot->read_inventaire_produit($_GET['q']);
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/inventaire.php';
    } 
    require __DIR__.'/../inc/footer.php';