<?php
function sanitize($elt) {
    if($elt === false) {
        redirect_with_message('Le nom doit etre present !', FLASH_ERROR, 'rapport', 'rapport.php');
    }
}
$comptabilite = new Comptabilite();
$sortieentreedepot = new SortieEntreeDepot();

$url = 'rapport.php';
$date1 = filter_input(INPUT_POST, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
$date2 = filter_input(INPUT_POST, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
$type_trie = filter_input(INPUT_POST, 'type_trie', FILTER_SANITIZE_SPECIAL_CHARS);
$request = filter_input(INPUT_POST, 'request', FILTER_SANITIZE_SPECIAL_CHARS);
sanitize($request);

if ($request == 'entree_comptabilite') {
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

if ($request == 'sortie_comptabilite') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

if ($request == 'entree_comptabilite_trie') {
    sanitize($type_trie);
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&typetrie=$type_trie");
}

if ($request == 'sortie_comptabilite_trie') {
    sanitize($type_trie);
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&typetrie=$type_trie");
}

if ($request == 'entree_depot') {
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

if ($request == 'sortie_depot') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

if ($request == 'entree_inventaire') {
    $type = 'entree';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

if ($request == 'sortie_inventaire') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type");
}

//

if ($request == 'entree_comptabilite2') {
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}

if ($request == 'sortie_comptabilite2') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}

if ($request == 'entree_comptabilite_trie2') {
    sanitize($type_trie);
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&typetrie=$type_trie&date2=$date2");
}

if ($request == 'sortie_comptabilite_trie2') {
    sanitize($type_trie);
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&typetrie=$type_trie&date2=$date2");
}

if ($request == 'entree_depot2') {
    $type = 'entrée';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}

if ($request == 'sortie_depot2') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}

if ($request == 'entree_inventaire') {
    $type = 'entree';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}

if ($request == 'sortie_inventaire') {
    $type = 'sortie';
    $input['date1'] = $date1;
    sanitize($date1);
    sanitize($date2);
    redirect_with_message('', FLASH_SUCCESS, 'rapport', "rapport.php?request=$request&date1=$date1&q=$type&date2=$date2");
}