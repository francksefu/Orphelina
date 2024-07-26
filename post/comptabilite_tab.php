<?php
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
$input['type'] = $type;
if ($type == 'entrée' || $type == 'sortie') {
    true;
} else {
    //
}

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'comptabilite', "comptabilite_tab.php?q=$type");
    }
    $idComptabilite = explode('_', $delete)[1];
    $comptabilite = new Comptabilite();
    if ($comptabilite->delete((int) $idComptabilite)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'comptabilite', "comptabilite_tab.php?q=$type");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'comptabilite', "comptabilite_tab.php?q=$type");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'comptabilite', "comptabilite_tab.php?q=$type");
    }
if ($addorupdate === 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['id'] = $id;

    if($id === false) {
        $errors['id'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier', FLASH_ERROR, 'comptabilite', "comptabilite_tab.php?q=$type");
    } 
    if((int) $id) {
        $array = filter_validate_comptabilite("comptabilite_tab.php?q=");
        $type = $array['type'];
        $montant = $array['montant'];
        $motif = $array['motif'];
        $date = $array['date'];
        $Nfacture = $array['Nfacture'];
        $comptabilite = new Comptabilite();
        if ($montant && $motif && $date && $Nfacture) {
            if ($comptabilite->update($montant, $motif, $date, $Nfacture, 1, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'comptabilite', "comptabilite_tab.php?q=$type");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'comptabilite', "comptabilite.php_tab?q=$type");
        }
    }
    
}
