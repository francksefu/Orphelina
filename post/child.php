<?php
    
    $array = filter_validate_child();
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
    $enfant = new Enfant();
    if ($nom) {
        if ($enfant->insert($nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification)) {
            redirect_with_message("Insertion fait avec success ! ", FLASH_SUCCESS, 'child', "child.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'child', "child.php");
    }
    
    

