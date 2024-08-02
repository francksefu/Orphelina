<?php
    
    $array = filter_validate_enfant();
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
        if ($enfant->insert($noms_postnoms, $sexe, $dateArrivee, $age, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'enfant', "enfant.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'enfant', "enfant.php");
    }
    
    

