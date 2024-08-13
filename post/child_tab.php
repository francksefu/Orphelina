<?php

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'child', "child_tab.php");
    }
    $idEnfant = explode('_', $delete)[1];
    $enfant = new Enfant();
    if ($enfant->delete((int) $idEnfant)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'child', "child_tab.php");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'child', "child_tab.php");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'child', "child_tab.php");
    }
if ($addorupdate === 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['id'] = $id;

    if($id === false) {
        $errors['id'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier', FLASH_ERROR, 'child', "child_tab.php");
    } 
    if((int) $id) {
        $array = filter_validate_child("child_tab.php");
        $nom = $array['nom'];
    $sexe = $array['sexe'];
    $dateNaissance = $array['dateNaissance'];
    $ecoleClassCourant = $array['ecoleClassCourant'];
    $dateArrivee = $array['dateArrivee'];
    $ageEntree = $array['ageEntree'];
    $freres_et_soeurs = $array['freres_et_soeurs'];
    $histoire = $array['histoire'];
    $sujet_favoris = $array['sujet_favoris'];
    $travail_de_reve = $array['travail_de_reve'];
    $nourriture_favoris = $array['nourriture_favoris'];
    $hobbies = $array['hobbies'];
    $couleur = $array['couleur'];
    $meilleur_ami = $array['meilleur_ami'];
    $talent = $array['talent'];
    $grand_reves = $array['grand_reves'];
    $traits_interessant = $array['traits_interessant'];
    $status_de_reunification = $array['status_de_reunification'];
    $description_sur_la_reunification = $array['description_sur_la_reunification'];
    $date_de_reunification = $array['date_de_reunification'];
        $child = new Enfant();
        if ($nom) {
            if ($enfant->update_child($nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'child', "child_tab.php");
            } else {
                redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'child', "child_tab.php");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'child', "child_tab.php");
        }
    }
    
}
