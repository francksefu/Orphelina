<?php

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'enfant', "enfant_tab.php");
    }
    $idEnfant = explode('_', $delete)[1];
    $enfant = new Enfant();
    if ($enfant->delete((int) $idEnfant)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'enfant', "enfant_tab.php");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'enfant', "enfant_tab.php");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'enfant', "enfant_tab.php");
    }
if ($addorupdate === 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['id'] = $id;

    if($id === false) {
        $errors['id'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier', FLASH_ERROR, 'enfant', "enfant_tab.php");
    } 
    if((int) $id) {
        $array = filter_validate_enfant("enfant_tab.php");
        $noms_postnoms = $array['noms_postnoms'];
        $sexe = $array['sexe'];
        $dateArrivee = $array['dateArrivee'];
        $age = $array['age'];
        $parents = $array['parents'];
        $provenance = $array['provenance'];
        $objetDeReferencement = $array['objetDeReferencement'];
        $observation_a_l_arrivee = $array['observation_a_l_arrivee'];
        $status_de_reunification = $array['status_de_reunification'];
        $description_sur_la_reunification = $array['description_sur_la_reunification'];
        $date_de_reunification = $array['date_de_reunification'];
        $enfant = new Enfant();
        if ($noms_postnoms) {
            if ($enfant->update($noms_postnoms, $sexe, $dateArrivee, $age, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'enfant', "enfant_tab.php");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'enfant', "enfant_tab.php");
        }
    }
    
}
