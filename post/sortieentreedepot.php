<?php
    
    $array = filter_validate_sortieentreedepot();
    $type = $array[0]['type'];
    $Nfacture = $array[0]['Nfacture'];
    $sortieentreedepot = new SortieEntreeDepot();
    if ($array) {
        if ($sortieentreedepot->insert_multiple($array)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'sortieentreedepot', "sortieentreedepot.php?q=$type");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'sortieentreedepot', "sortieentreedepot.php?q=$type");
    }

    header("Location: sortieentreedepot.php?q=$type", true, 303);
    exit;
    
    

