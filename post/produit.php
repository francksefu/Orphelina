<?php
    
    $array = filter_validate_produit();
    $nom = $array['nom'];
    $description = $array['description'];
    $quantiteStock = $array['quantiteStock'];
    $prixUnitaire = $array['prixUnitaire'];
    $idTypeProduit = 1;
    $produit = new Produit();
    if ($nom && $idTypeProduit ) {
        if ($produit->insert($nom, $description, $quantiteStock, $prixUnitaire, 1)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'produit', "produit.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'produit', "produit.php");
    }
    
    

