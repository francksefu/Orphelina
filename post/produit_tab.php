<?php

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'produit', "produit_tab.php");
    }
    $idProduit = explode('_', $delete)[1];
    $produit = new Produit();
    if ($produit->delete((int) $idProduit)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'produit', "produit_tab.php");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'produit', "produit_tab.php");
    }

}
    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['addorupdate'] = $addorupdate;

    if($addorupdate === false) {
        $errors['addorupdate'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier !', FLASH_ERROR, 'produit', "produit_tab.php");
    }
if ($addorupdate === 'update') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['id'] = $id;

    if($id === false) {
        $errors['id'] = 'Impossible de modifier';
        redirect_with_message('Impossible de modifier', FLASH_ERROR, 'produit', "produit_tab.php");
    } 
    if((int) $id) {
        $array = filter_validate_produit("produit_tab.php");
        $nom = $array['nom'];
        $description = $array['description'];
        $quantiteStock = $array['quantiteStock'];
        $prixUnitaire = $array['prixUnitaire'];
        $idTypeProduit = 1;
        $produit = new Produit();
        if ($nom && $idTypeProduit) {
            if ($produit->update($nom, $description, $quantiteStock, $prixUnitaire, 1, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'produit', "produit_tab.php");
            }
        } else {
            redirect_with_message('Error, la modification n a pas ete faite', FLASH_ERROR, 'produit', "produit_tab.php");
        }
    }
    
}
