
<?php 
$comptabilite = new Comptabilite();
$sortieentreedepot = new SortieEntreeDepot();
$produit = new Produit();
if(! isset($_GET['request'])) {
    echo add_rapport(htmlspecialchars($_SERVER['PHP_SELF']), $array_of_type_trie ); 
} else {
    if($_GET['request'] == 'entree_comptabilite' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('entrée', $date1);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entrée comptabilité</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'sortie_comptabilite' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('sortie', $date1);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie comptabilité</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'entree_comptabilite_trie' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $type_trie = $request = filter_input(INPUT_GET, 'typetrie', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('entrée', $date1, null, $type_trie);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entree comptabilité trie</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'sortie_comptabilite_trie' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $type_trie = $request = filter_input(INPUT_GET, 'typetrie', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('sortie', $date1, null, $type_trie);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie comptabilité trie</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }

    if($_GET['request'] == 'entree_depot' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_group_by_facture('entrée', $date1);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entrée depot</h2>";
        echo sortieentreedepot_tab($arr, $produit->read());
    }

    if($_GET['request'] == 'sortie_depot' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_group_by_facture('sortie', $date1);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie depot</h2>";
        echo sortieentreedepot_tab($arr, $produit->read());
    }

    if($_GET['request'] == 'entree_inventaire' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_inventaire_produit('entree', $date1);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'>Inventaire des entrées</h2>";
        echo inventaire($arr);
    }

    if($_GET['request'] == 'sortie_inventaire' && $_GET['date1']) {
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_inventaire_produit('sortie', $date1);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'>Inventaire des sorties</h2>";
        echo inventaire($arr);
    }
    //

    if($_GET['request'] == 'entree_comptabilite2' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('entrée', $date1, $date2);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entrée comptabilité</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'sortie_comptabilite2' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $arr = $comptabilite->read('sortie', $date1, $date2);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie comptabilité</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'entree_comptabilite_trie2' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $type_trie = $request = filter_input(INPUT_GET, 'typetrie', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('entrée', $date1, $date2, $type_trie);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entree comptabilité trie</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }
    if($_GET['request'] == 'sortie_comptabilite_trie2' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $type_trie = $request = filter_input(INPUT_GET, 'typetrie', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $comptabilite->read('sortie', $date1, $date2, $type_trie);
        $total = array_reduce(
            $arr,
            function ($prev, $item) {
                return $prev + $item['montant'];
            }
        );
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie comptabilité trie</h2>";
        echo "<h5 class='text-secondary text-center'>total : $total USD</h5>";
        echo comptabilite_tab($arr);
    }

    if($_GET['request'] == 'entree_depot' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_group_by_facture('entrée', $date1, $date2);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Entrée depot</h2>";
        echo sortieentreedepot_tab($arr, $produit->read());
    }

    if($_GET['request'] == 'sortie_depot' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_group_by_facture('sortie', $date1, $date2);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'> Sortie depot</h2>";
        echo sortieentreedepot_tab($arr, $produit->read());
    }

    if($_GET['request'] == 'entree_inventaire2' && $_GET['date1']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_inventaire_produit('entree', $date1, $date2);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'>Inventaire des entrées</h2>";
        echo inventaire($arr);
    }

    if($_GET['request'] == 'sortie_inventaire' && $_GET['date2']) {
        $date2 = $request = filter_input(INPUT_GET, 'date2', FILTER_SANITIZE_SPECIAL_CHARS);
        $date1 = $request = filter_input(INPUT_GET, 'date1', FILTER_SANITIZE_SPECIAL_CHARS);
        $arr = $sortieentreedepot->read_inventaire_produit('sortie', $date1, $date2);
        echo "<h2 class='text-center text-secondary mt-3 mb-3'>Inventaire des sorties</h2>";
        echo inventaire($arr);
    }
}
    