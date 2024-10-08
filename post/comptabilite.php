<?php
    $array = filter_validate_comptabilite();
    $type = $array['type'];
    $montant = $array['montant'];
    $motif = $array['motif'];
    $date = $array['date'];
    $Nfacture = $array['Nfacture'];
    $idTypeTrie = $array['idTypeTrie'];
    $comptabilite = new Comptabilite();
    if ($type === 'entrée') {
        if ($montant && $motif && $date && $Nfacture) {
            if ($comptabilite->insert($montant, $motif, $date, $Nfacture, $type, $idTypeTrie)) {
                redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'comptabilite', "comptabilite.php?q=$type");
            }
        } else {
            redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'comptabilite', "comptabilite.php?q=$type");
        }
    } elseif($type === 'sortie') {
        if ($montant && $motif && $date && $Nfacture) {
            if ($comptabilite->insert($montant, $motif, $date, $Nfacture, 'sortie', $idTypeTrie)) {
                redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'comptabilite', "comptabilite.php?q=$type");
            }
        } else {
            redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'comptabilite', "comptabilite.php?q=$type");
        }
    } else {
        redirect_with_message('Mauvais type !', FLASH_ERROR, 'comptabilite', "comptabilite.php?q=$type");
    }

    

