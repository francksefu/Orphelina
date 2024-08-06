<?php
function add_update_child($urlpost, $flash = '', $nom = '', $sexe = '', $dateNaissance = '', $ecoleClassCourant = '', $dateArrivee = '', $ageEntree = '', $freres_et_soeurs = '', $histoire = '', $sujet_favoris = '', $travail_de_reve = '', $nourriture_favoris = '', $hobbies = '', $couleur = '', $meilleur_ami = '', $talent = '', $grand_reves = '', $traits_interessant = '', $status_de_reunification = '', $description_sur_la_reunification = '', $date_de_reunification = '', $addorupdate = 'add', $id = '') {
    $width = $addorupdate == 'add' ? 6 : 10;
        $selected_precis = '';
        $selected = '';
        $selected_ans = '';
        $selected_mois = '';
        $selected_semaine = '';
        $selected_jour = '';
        $age_number = '';
        $selected_reunifie = $status_de_reunification == 'reunifie' ? 'selected' : '';
        $selected_non_reunifie = $status_de_reunification == 'non reunifie' ? 'selected' : '';
    if(! empty($ageEntree)) {
        $age_tab = explode(' ', $ageEntree);
        $age_precis = $age_tab[0];
        $age_number = $age_tab[1];
        $age_time = $age_tab[2];
        $selected_precis = $age_precis == 'precis:' ? 'selected' : '';
        $selected = $age_precis == '+/-' ? 'selected' : '';
        $selected_ans = $age_time == 'ans' ? 'selected' : '';
        $selected_mois = $age_time == 'mois' ? 'selected' : '';
        $selected_semaine = $age_time == 'semaine' ? 'selected' : '';
        $selected_jour = $age_time == 'jours' ? 'selected' : '';
    }
    $selected_masculin = $sexe == 'Masculin' ? 'selected' : '';
    $selected_feminin = $sexe == 'Feminin' ? 'selected' : '';
    
    $reunification = $addorupdate == 'add' ? "" : "
                <div class='input-group mb-3'>
                    <span class='input-group-text'>Description dur la reunification</span>
                    <textarea name='description_sur_la_reunification'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$description_sur_la_reunification</textarea>
                </div>
                <small class='text-danger'></small>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Parents </span>
                    <input type='date' name='date_de_reunification' class='form-control' value='$date_de_reunification' placeholder='Ecrivez ici les noms des parents ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>";
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Enfant</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-$width'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Nom')."</span>
                    <input type='text' name='nom' class='form-control' value='$nom' placeholder='Ecrivez le nom de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <label class='input-group-text' for='inputGroupSelect01'>Sexe</label>
                    <select class='form-select' name='sexe' value='$sexe' id='inputGroupSelect01'>
                        <option value='Masculin' $selected_masculin>Masculin</option>
                        <option value='Feminin' $selected_feminin>Feminin</option>
                    </select>
                </div>
                <small class='text-danger'></small>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Date de naissance')."</span>
                    <input type='date' name='dateNaissance' class='form-control' value='$dateNaissance' placeholder='Ecrivez le nom de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('annee d ecole')."</span>
                    <input type='text' name='ecoleClassCourant' class='form-control' value='$ecoleClassCourant' placeholder='Ecrivez l annee courant a l ecole' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                
                <small class='text-danger'></small>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Date d arrivee')." </span>
                    <input type='date' name='dateArrivee' class='form-control' value='$dateArrivee' placeholder='Ecrivez la date de l arrivee de l enfant dans l orphelina ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Age à l entrée')."</span>
                    <span class='input-group-text' id='basic-addon1'>
                    <select class='form-select' id='age_precis' >
                        <option value='precis:' $selected_precis>precis</option>
                        <option value='+/-' $selected>+/-</option>
                    </select>
                    </span>
                    <input type='hidden' name='ageEntree' id='age' value='$ageEntree'>
                    <input type='number' required value='$age_number' id='age_number' step='0.5' class='form-control' placeholder='Ecrivez la date de naissance de l enfant si vous la connaissez ici' aria-label='Username' aria-describedby='basic-addon1'>
                    <span class='input-group-text' id='basic-addon1'>
                        <select class='form-select' id='age_time' >
                            <option value='ans' $selected_ans>ans</option>
                            <option value='mois' $selected_mois>mois</option>
                            <option value='semaines' $selected_semaine>semaines</option>
                            <option value='jours' $selected_jour>jours</option>
                        </select>
                    </span>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Freres et soeurs?')." </span>
                    <input type='text' name='freres_et_soeurs' class='form-control' value='$freres_et_soeurs' placeholder='Ecrivez ici les noms des freres et soeurs ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                
                <div class='input-group mb-3'>
                    <span class='input-group-text'>Arriere plan</span>
                    <textarea name='histoire'  class='form-control' placeholder='Ecrivez l histoire de l enfant ici ...' aria-label='With textarea'>$histoire</textarea>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Sujet favori')." </span>
                    <input type='text' name='sujet_favoris' class='form-control' value='$sujet_favoris' placeholder='Ecrivez ici le sujet favoris ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Travail de reve </span>
                    <input type='text' name='travail_de_reve' class='form-control' value='$freres_et_soeurs' placeholder='Ecrivez ici les noms des freres et soeurs ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Nourriture favorite')." </span>
                    <input type='text' name='nourriture_favoris' class='form-control' value='$nourriture_favoris' placeholder='Ecrivez ici la nourriture favoris de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text'>".tr('Passe-temps')."</span>
                    <textarea name='hobbies'  class='form-control' placeholder='Ecrivez l histoire de l enfant ici ...' aria-label='With textarea'>$hobbies</textarea>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Couleur')."</span>
                    <input type='text' name='couleur' class='form-control' value='$couleur' placeholder='Ecrivez ici la nourriture favoris de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>".tr('Meilleur ami')." </span>
                    <input type='text' name='meilleur_ami' class='form-control' value='$meilleur_ami' placeholder='Ecrivez ici la nourriture favoris de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Talents </span>
                    <input type='text' name='talent' class='form-control' value='$talent' placeholder='Ecrivez ici la nourriture favoris de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Grand reve </span>
                    <input type='text' name='grand_reves' class='form-control' value='$grand_reves' placeholder='Ecrivez ici la nourriture favoris de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Traits interessant </span>
                    <input type='text' name='traits_interessant' class='form-control' value='$traits_interessant' placeholder='Ecrivez ici les traits interessant de l enfant ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <label class='input-group-text' for='inputGroupSelect01'>Status de reunification</label>
                    <select class='form-select' id='inputGroupSelect01' name='status_de_reunification' value='$status_de_reunification'>
                        <option value='non reunifie' $selected_reunifie>non reunifier</option>
                        <option value='reunifie' $selected_non_reunifie>reunifier</option>
                    </select>
                </div>
                
                $reunification
                
            </div>
        </div>
        
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre'>
    </form>";
    return $content;
}

function filter_validate_child( $url = 'child.php')
{
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['nom'] = $nom;
    if($nom === false) {
        $errors['nom'] = 'Le noms et post-noms doit etre present';
        redirect_with_message('Le noms et post-noms doit etre present', FLASH_ERROR, 'child', $url);
    }

    $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['sexe'] = $sexe;
    
    $ecoleClassCourant = filter_input(INPUT_POST, 'ecoleClassCourant', FILTER_SANITIZE_SPECIAL_CHARS);
    $freres_et_soeurs = filter_input(INPUT_POST, 'freres_et_soeurs', FILTER_SANITIZE_SPECIAL_CHARS);
    $histoire = filter_input(INPUT_POST, 'histoire', FILTER_SANITIZE_SPECIAL_CHARS);
    $sujet_favoris = filter_input(INPUT_POST, 'sujet_favoris', FILTER_SANITIZE_SPECIAL_CHARS);
    $travail_de_reve = filter_input(INPUT_POST, 'travail_de_reve', FILTER_SANITIZE_SPECIAL_CHARS);
    $nourriture_favoris = filter_input(INPUT_POST, 'nourriture_favoris', FILTER_SANITIZE_SPECIAL_CHARS);
    $hobbies = filter_input(INPUT_POST, 'hobbies', FILTER_SANITIZE_SPECIAL_CHARS);
    $couleur = filter_input(INPUT_POST, 'couleur', FILTER_SANITIZE_SPECIAL_CHARS);
    $meilleur_ami = filter_input(INPUT_POST, 'meilleur_ami', FILTER_SANITIZE_SPECIAL_CHARS);
    $talent = filter_input(INPUT_POST, 'talent', FILTER_SANITIZE_SPECIAL_CHARS);
    $grand_reves = filter_input(INPUT_POST, 'grand_reves', FILTER_SANITIZE_SPECIAL_CHARS);
    $traits_interessant = filter_input(INPUT_POST, 'traits_interessant', FILTER_SANITIZE_SPECIAL_CHARS);
    $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($dateNaissance == '') {
        $dateNaissance = null;
    }

    $dateArrivee = filter_input(INPUT_POST, 'dateArrivee', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['dateArrivee'] = $dateArrivee;
    if($dateArrivee === false) {
        $errors['dateArrivee'] = 'La date d arrivée doit etre present';
        redirect_with_message('La date d arrivée doit etre present', FLASH_ERROR, 'child', $url);
    }

    $ageEntree = filter_input(INPUT_POST, 'ageEntree', FILTER_SANITIZE_SPECIAL_CHARS);
    if($ageEntree === false) {
        $errors['age'] = 'L age doit etre present';
        redirect_with_message('L age a l entree doit etre presente', FLASH_ERROR, 'child', $url);
    }

    $status_de_reunification = filter_input(INPUT_POST, 'status_de_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['status_de_reunification'] = $status_de_reunification;

    $description_sur_la_reunification = filter_input(INPUT_POST, 'description_sur_la_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['description_sur_la_reunification'] = $description_sur_la_reunification;

    $date_de_reunification = filter_input(INPUT_POST, 'date_de_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['date_de_reunification'] = $date_de_reunification;
    
    return ['nom' => $nom, 'sexe' => $sexe, 'dateArrivee' => $dateArrivee, 'ageEntree' => $ageEntree, 'dateNaissance' => $dateNaissance, 'ecoleClassCourant' => $ecoleClassCourant, 'freres_et_soeurs' => $freres_et_soeurs, 'histoire' => $histoire, 'sujet_favoris' => $sujet_favoris, 'travail_de_reve' => $travail_de_reve, 'nourriture_favoris' => $nourriture_favoris, 'hobbies' => $hobbies, 'couleur' => $couleur, 'meilleur_ami' => $meilleur_ami, 'talent' => $talent, 'grand_reves' => $grand_reves, 'traits_interessant' => $traits_interessant, 'status_de_reunification' => $status_de_reunification, 'description_sur_la_reunification' => $description_sur_la_reunification, 'date_de_reunification' => $date_de_reunification];
}

function child_tab($default_array, $total = '') {
    $line = '';
    
    foreach($default_array as $array) {
        $suppression =(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? "
                        <button type='button' class='btn btn-danger p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#delete_".$array['idEnfant']."'>
                            Supprimer
                        </button>

                        <button type='button' class='btn btn-warning p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#update_".$array['idEnfant']."'>
                            Modifier
                        </button>" : '';
                        $content_update = add_update_child(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['nom'], $array['sexe'], $array['dateNaissance'], $array['ecoleClassCourant'], $array['dateArrivee'], $array['ageEntree'], $array['freres_et_soeurs'], $array['histoire'], $array['sujet_favoris'], $array['travail_de_reve'], $array['nourriture_favoris'], $array['hobbies'], $array['couleur'], $array['meilleur_ami'], $array['talent'], $array['grand_reves'], $array['traits_interessant'], $array['status_de_reunification'], $array['description_sur_la_reunification'], $array['date_de_reunification'], 'update', $array['idEnfant']);
                        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("delete_".$array['idEnfant']."", "Supprimer l enfant ".$array['nom']."", "Voulez-vous vraiment supprimer cet enfant ".$array['nom']." qui a l ID : ".$array['idEnfant']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idEnfant']."", 'supprimer') : '';
                        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("update_".$array['idEnfant']."", 'Modifier l enfant', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idEnfant']."", 'modifier', '', false) : '';
        
        $line .= "
                <tr>
                    <th>".$array['idEnfant']."</th>
                    <td>".$array['nom']." <br> <a href='voirenfant.php?q=".$array['idEnfant']."' class='btn btn-success m-2'> Voir</a> </td>
                    <td>".$array['sexe']."</td>
                    <td>".$array['dateNaissance']."</td>
                    <td>".$array['ecoleClassCourant']."</td>
                    <td>".$array['dateArrivee']."</td>
                    <td>".$array['ageEntree']."</td>
                    <td>".$array['freres_et_soeurs']."</td>
                    <td>".$array['histoire']."</td>
                    <td>".$array['sujet_favoris']."</td>
                    <td>".$array['travail_de_reve']." </td>
                    <td>".$array['nourriture_favoris']."</td>
                    <td>".$array['hobbies']."</td>
                    <td>".$array['couleur']."</td>
                    <td>".$array['meilleur_ami']."</td>
                    <td>".$array['talent']."</td>
                    <td>".$array['grand_reves']."</td>
                    <td>".$array['traits_interessant']."</td>
                    <td>".$array['status_de_reunification']."</td>
                    <td>".$array['description_sur_la_reunification']."</td>
                    <td>".$array['date_de_reunification']."</td>
                    
                    <td class='bd-highlight mb-3'>
                        $suppression
                    </td>
                </tr>
        ";
        
    }
        $content = "
        <div class='row'>
        <div class='col-md-7'></div>
        <div class='col-md-4'><small>total :  $total  </small></div>
    </div>
    ".recherche_dans_tableau()."
<div class='horizontal'>
<table class='table table-bordered' >
    <thead>
        <tr>
        <th scope='col'>id</th>
        <th scope='col'>".tr('Nom')."</th>
        <th scope='col'>Sexe</th>
        <th scope='col'>".tr('Date de naissance')."</th>
        <th scope='col'>".tr('annee d ecole')."</th>
        <th scope='col'>".tr('Date d arrivee')."</th>
        <th scope='col'>".tr('Age à l entrée')."</th>
        <th scope='col'>".tr('Siblings at home?')."</th>
        <th scope='col'>".tr('Arriere-plan')."</th>
        <th scope='col'>".tr('Sujet favori')."</th>
        <th scope='col'>".tr('Quel est le travail de tes reves?')."</th>
        <th scope='col'>".tr('Nourriture favorite')."</th>
        <th scope='col'>".tr('Passe-temps')."</th>
        <th scope='col'>".tr('Couleur')."</th>
        <th scope='col'>".tr('Meilleur ami')."</th>
        <th scope='col'>Talents</th>
        <th scope='col'>".tr('Quel est ton plus grand reve ou souhait?')."</th>
        <th scope='col'>".tr('Fait ou caracter interessant sur l enfant')."</th>
        <th scope='col'>".tr('Status de reunification')."</th>
        <th scope='col'>".tr('Description sur la reunification')."</th>
        <th scope='col'>".tr('Date de reunification')."</th>
        
        <th scope='col'>action</th>
        </tr>
    </thead>
    <tbody id='tbody'>
        $line
    </tbody>
</table>
</div>
        ";
    return $content;
   } 