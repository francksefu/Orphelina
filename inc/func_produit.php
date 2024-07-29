<?php
function add_update_produit($urlpost, $flash = '', $nom = '', $marque = '', $quantiteStock = '' , $description = '', $prixUnitaire = '', $addorupdate = 'add', $id = '', $unite_mesure = '', $package = '', $nom_package = '') {
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Produit</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-6'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Nom </span>
                    <input type='text' name='nom' class='form-control' value='$nom' placeholder='Ecrivez le nom du produit ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Marque </span>
                    <input type='text' name='marque' class='form-control' value='$marque' placeholder='Ecrivez la marque du produit ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Quantite en stock</span>
                    <input required type='float' name='quantiteStock' value='$quantiteStock' class='form-control' placeholder='ecrivez la quantite en stock' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>
                
            </div>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Prix unitaire</span>
                <input required type='float' value='$prixUnitaire' name='prixUnitaire' step='0.001' placeholder='Ecrivez le prix unitaire ici' class='form-control' aria-label='Amount (to the nearest dollar)'>
                <span class='input-group-text'>USD</span>
            </div>
            <small class='text-danger'></small>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Description</span>
                <textarea name='description'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$description</textarea>
            </div>
            <small class='text-danger'></small>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text' id='basic-addon1'>Unite de mesure </span>
                <input required type='text' name='unite_mesure' class='form-control' value='$unite_mesure' placeholder='Ecrivez l unité de mesure ici... (ex: Kg)' aria-label='Username' aria-describedby='basic-addon1'>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Paquet</span>
                <input type='float' value='$package' name='package' step='0.001' placeholder='Ecrivez le paquet contient combien d unite de mesure ici' class='form-control' aria-label='Amount (to the nearest dollar)'>
            </div>
            <small class='text-danger'></small>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text' id='basic-addon1'>Nom du package </span>
                <input type='text' name='nom_package' class='form-control' value='$nom_package' placeholder='Ecrivez le nom du packet ici... (ex: sac de 140Kg)' aria-label='Username' aria-describedby='basic-addon1'>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <label class='input-group-text' for='inputGroupSelect01'>Type</label>
                <select class='form-select' id='inputGroupSelect01'>
                    <option selected>Choose...</option>
                    <option value='1'>One</option>
                    <option value='2'>Two</option>
                    <option value='3'>Three</option>
                </select>
            </div>
            <small class='text-danger'></small>
        </div>
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre'>
    </form>";
    return $content;
}

function filter_validate_produit( $url = 'produit.php')
{
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['nom'] = $nom;
    if($nom === false) {
        $errors['nom'] = 'Le nom doit etre present';
        redirect_with_message('Le nom doit etre present !', FLASH_ERROR, 'produit', $url);
    }

    $quantiteStock = filter_input(INPUT_POST, 'quantiteStock', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input['quantiteStock'] = $quantiteStock;

    if($quantiteStock === false) {
        $errors['quantiteStock'] = 'La quantite en stock doit etre presente';
        redirect_with_message('Le quantite en stock doit etre present et etre un chiffre', FLASH_ERROR, 'produit', $url);
    }

    $prixUnitaire = filter_input(INPUT_POST, 'prixUnitaire', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input['prixUnitaire'] = $prixUnitaire;

    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['description'] = $description;

    $idTypeProduit = filter_input(INPUT_POST, 'idTypeProduit', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['idTypeProduit'] = $idTypeProduit;

    $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['marque'] = $marque;

    /*if($idTypeProduit === false) {
        $errors['idTypeProduit'] = 'Le type du produit doit etre present';
        redirect_with_message('Le type du produit doit etre present', FLASH_ERROR, 'produit', $url);
    }*/

    $unite_mesure = filter_input(INPUT_POST, 'unite_mesure', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['unite_mesure'] = $unite_mesure;

    if($unite_mesure === false) {
        $errors['unite_mesure'] = 'L unite de mesure doit etre presente';
        redirect_with_message('L unite de mesure doit etre presente', FLASH_ERROR, 'produit', $url);
    }

    $package = filter_input(INPUT_POST, 'package', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['package'] = $package;

    $nom_package = filter_input(INPUT_POST, 'nom_package', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['nom_package'] = $nom_package;
    
    return ['nom' => $nom, 'marque' => $marque, 'description' => $description, 'quantiteStock' => $quantiteStock, 'prixUnitaire' => $prixUnitaire, 'idTypeProduit' => $idTypeProduit, 'unite_mesure' => $unite_mesure, 'package' => $package, 'nom_package' => $nom_package];
}