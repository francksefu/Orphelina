<?php
    
    $array = filter_validate_produit();
    $nom = $array['nom'];
    $marque = $array['marque'];
    $description = $array['description'];
    $quantiteStock = $array['quantiteStock'];
    $prixUnitaire = $array['prixUnitaire'];
    $idTypeProduit = 1;
    $unite_mesure = $array['unite_mesure'];
    $package = $array['package'];
    $nom_package = $array['nom_package'];
    $produit = new Produit();
    if ($nom && $idTypeProduit ) {
        if ($produit->insert($nom, $marque, $description, $quantiteStock, $prixUnitaire, 1, $unite_mesure, $package, $nom_package)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'produit', "produit.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'produit', "produit.php");
    }
    
    

