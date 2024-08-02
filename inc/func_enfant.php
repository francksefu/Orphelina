<?php
function add_update_enfant($urlpost, $flash = '', $noms_postnoms = '', $sexe = '', $dateArrivee = '' , $age = '', $parents = '', $provenance = '', $objetDeReferencement = '', $observation_a_l_arrivee = '', $status_de_reunification = '', $description_sur_la_reunification = '', $date_de_reunification = '', $addorupdate = 'add', $id = '') {
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
    if(! empty($age)) {
        $age_tab = explode(' ', $age);
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
                    <span class='input-group-text' id='basic-addon1'>Nom et post noms</span>
                    <input type='text' name='noms_postnoms' class='form-control' value='$noms_postnoms' placeholder='Ecrivez le nom de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
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
                    <span class='input-group-text' id='basic-addon1'>Date d'arrivée </span>
                    <input type='date' name='dateArrivee' class='form-control' value='$dateArrivee' placeholder='Ecrivez la date de l arrivee de l enfant dans l orphelina ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Age </span>
                    <span class='input-group-text' id='basic-addon1'>
                    <select class='form-select' id='age_precis' >
                        <option value='precis:' $selected_precis>precis</option>
                        <option value='+/-' $selected>+/-</option>
                    </select>
                    </span>
                    <input type='hidden' name='age' id='age' value='$age'>
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
                    <span class='input-group-text' id='basic-addon1'>Parents </span>
                    <input type='text' name='parents' class='form-control' value='$parents' placeholder='Ecrivez ici les noms des parents ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                
                <div class='input-group mb-3'>
                    <span class='input-group-text'>Provenance</span>
                    <textarea name='provenance'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$provenance</textarea>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text'>Objet de referencement</span>
                    <textarea name='objetDeReferencement'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$objetDeReferencement</textarea>
                </div>
                <small class='text-danger'></small>

                <div class='input-group mb-3'>
                    <span class='input-group-text'>Observation a l arrivee</span>
                    <textarea name='observation_a_l_arrivee'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$observation_a_l_arrivee</textarea>
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

function filter_validate_enfant( $url = 'enfant.php')
{
    $noms_postnoms = filter_input(INPUT_POST, 'noms_postnoms', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['noms_postnoms'] = $noms_postnoms;
    if($noms_postnoms === false) {
        $errors['noms_postnoms'] = 'Le noms et post-noms doit etre present';
        redirect_with_message('Le noms et post-noms doit etre present', FLASH_ERROR, 'employe', $url);
    }

    $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['sexe'] = $sexe;
    

    $dateArrivee = filter_input(INPUT_POST, 'dateArrivee', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['dateArrivee'] = $dateArrivee;
    if($dateArrivee === false) {
        $errors['dateArrivee'] = 'La date d arrivée doit etre present';
        redirect_with_message('La date d arrivée doit etre present', FLASH_ERROR, 'enfant', $url);
    }

    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['age'] = $age;
    if($age === false) {
        $errors['age'] = 'L age doit etre present';
        redirect_with_message('L age doit etre presente', FLASH_ERROR, 'enfant', $url);
    }

    $parents = filter_input(INPUT_POST, 'parents', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['parents'] = $parents;    

    $provenance = filter_input(INPUT_POST, 'provenance', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['provenance'] = $provenance;

    $objetDeReferencement = filter_input(INPUT_POST, 'objetDeReferencement', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['objetDeReferencement'] = $objetDeReferencement;

    $observation_a_l_arrivee = filter_input(INPUT_POST, 'observation_a_l_arrivee', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['observation_a_l_arrivee'] = $observation_a_l_arrivee;

    $status_de_reunification = filter_input(INPUT_POST, 'status_de_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['status_de_reunification'] = $status_de_reunification;

    $description_sur_la_reunification = filter_input(INPUT_POST, 'description_sur_la_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['description_sur_la_reunification'] = $description_sur_la_reunification;

    $date_de_reunification = filter_input(INPUT_POST, 'date_de_reunification', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['date_de_reunification'] = $date_de_reunification;
    
    return ['noms_postnoms' => $noms_postnoms, 'sexe' => $sexe, 'dateArrivee' => $dateArrivee, 'age' => $age, 'parents' => $parents, 'provenance' => $provenance, 'objetDeReferencement' => $objetDeReferencement, 'observation_a_l_arrivee' => $observation_a_l_arrivee, 'status_de_reunification' => $status_de_reunification, 'description_sur_la_reunification' => $description_sur_la_reunification, 'date_de_reunification' => $date_de_reunification];
}