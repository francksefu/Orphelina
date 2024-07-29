<?php
    
    $array = filter_validate_employe();
    $noms_postnoms = $array['noms_postnoms'];
    $fonction = $array['fonction'];
    $phone = $array['phone'];
    $adressemail = $array['adressemail'];
    $dateNaissance = $array['dateNaissance'];
    $dateEntreEnService = $array['dateEntreEnService'];
    $dateFinService = $array['dateFinService'];
    $employe = new Employe();
    if ($noms_postnoms) {
        if ($employe->insert($noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreEnService, $dateFinService)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'employe', "employe.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'employe', "employe.php");
    }
    
    

