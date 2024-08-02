<?php

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'employe', "employe_tab.php");
    }
    $idEmployes = explode('_', $delete)[1];
    $employe = new Employe();
    if ($employe->delete((int) $idEmployes)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'employe', "employe_tab.php");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'employe', "employe_tab.php");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'employe', "employe_tab.php");
    }
if ($addorupdate === 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['id'] = $id;

    if($id === false) {
        $errors['id'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier', FLASH_ERROR, 'employe', "employe_tab.php");
    } 
    if((int) $id) {
        $array = filter_validate_employe("employe_tab.php");
        $noms_postnoms = $array['noms_postnoms'];
        $fonction = $array['fonction'];
        $phone = $array['phone'];
        $adressemail = $array['adressemail'];
        $dateNaissance = $array['dateNaissance'];
        $dateEntreEnService = $array['dateEntreEnService'];
        $dateFinService = $array['dateFinService'];
        $employe = new Employe();
        if ($noms_postnoms) {
            if ($employe->update($noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreEnService, $dateFinService, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'employe', "employe_tab.php");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'employe', "employe_tab.php");
        }
    }
    
}
