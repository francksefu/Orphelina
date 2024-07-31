<?php
$type = $delete = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
    }
    $Nfacture = explode('_', $delete)[1];
    $sortieentreedepot = new SortieEntreeDepot();
    if ($sortieentreedepot->delete($Nfacture)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
    }
if ($addorupdate === 'update') {
    
    $array = filter_validate_sortieentreedepot("sortieentreedepot_tab.php?q=");
    $Nfacture = $array[0]['Nfacture'];
    $type = $array[0]['type'];
    if($Nfacture) {
        
        $sortieentreedepot = new SortieEntreedepot();
        if ($Nfacture && $type) {
            if ($sortieentreedepot->update($Nfacture, $array)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'sortieentreedepot', "sortieentreedepot_tab.php?q=$type");
        }
    }
    
}
