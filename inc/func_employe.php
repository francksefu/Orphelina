<?php
function add_update_employe($urlpost, $flash = '', $noms_postnoms = '', $fonction = '', $phone = '' , $adressemail = '', $dateNaissance = '', $dateEntreEnService = '', $dateFinService = '', $addorupdate = 'add', $id = '') {
    $width = $addorupdate == 'add' ? 6 : 10;
    $finService = $addorupdate == 'add' ? "" : "<div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Date de fin de service </span>
                    <input type='date' name='dateFinService' class='form-control' value='$dateFinService' placeholder='Ecrivez la date de fin des services de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>";
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Employés</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-$width'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Nom et post noms</span>
                    <input type='text' name='noms_postnoms' class='form-control' value='$noms_postnoms' placeholder='Ecrivez le nom de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Fonction </span>
                    <input type='text' name='fonction' class='form-control' value='$fonction' placeholder='Ecrivez la fonction de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Numero de telephone </span>
                    <input type='text' name='phone' class='form-control' value='$phone' placeholder='Ecrivez le numero de phone de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Adresse mail </span>
                    <input type='text' name='adressemail' class='form-control' value='$adressemail' placeholder='Ecrivez l'adresse mail de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Date de naissance </span>
                    <input type='date' name='dateNaissance' class='form-control' value='$dateNaissance' placeholder='Ecrivez la date de naissance de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Date d entrée en service </span>
                    <input type='date' name='dateEntreEnService' class='form-control' value='$dateEntreEnService' placeholder='Ecrivez la date d entree en service de l employé ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                $finService
                
            </div>
        </div>
        
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre'>
    </form>";
    return $content;
}

function filter_validate_employe( $url = 'employe.php')
{
    $noms_postnoms = filter_input(INPUT_POST, 'noms_postnoms', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['noms_postnoms'] = $noms_postnoms;
    if($noms_postnoms === false) {
        $errors['noms_postnoms'] = 'Le noms et post-noms doit etre present';
        redirect_with_message('Le noms et post-noms doit etre present', FLASH_ERROR, 'employe', $url);
    }

    $fonction = filter_input(INPUT_POST, 'fonction', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['fonction'] = $fonction;
    if($fonction === false) {
        $errors['fonction'] = 'La fonction doit etre present';
        redirect_with_message('La fonction doit etre present', FLASH_ERROR, 'employe', $url);
    }

    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['phone'] = $phone;

    $adressemail = filter_input(INPUT_POST, 'adressemail', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['adressemail'] = $adressemail;

    $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['dateNaissance'] = $dateNaissance;

    $dateEntreEnService = filter_input(INPUT_POST, 'dateEntreEnService', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['dateNaissance'] = $dateEntreEnService;

    $dateFinService = filter_input(INPUT_POST, 'dateEntreEnService', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['dateNaissance'] = $dateFinService;
    
    return ['noms_postnoms' => $noms_postnoms, 'fonction' => $fonction, 'phone' => $phone, 'adressemail' => $adressemail, 'dateNaissance' => $dateNaissance, 'dateEntreEnService' => $dateEntreEnService, 'dateFinService' => $dateFinService];
}

function employe_tab($default_array) {
    $recherche = recherche_dans_tableau();
    $line = "";
    foreach($default_array as $array) {
        $suppression = (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? "<button type='button' class='btn btn-danger p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#delete_".$array['idEmployes']."'>
                            Supprimer
                        </button>

                        <button type='button' class='btn btn-warning p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#update_".$array['idEmployes']."'>
                            Modifier
                        </button>" : '';
        $line .= "
                <tr>
                    <th>".$array['idEmployes']."</th>
                    <td>".$array['noms_postnoms']."</td>
                    <td>".$array['fonction']."</td>
                    <td>".$array['phone']."</td>
                    <td>".$array['adressemail']."</td>
                    <td>".$array['dateNaissance']."</td>
                    <td>".$array['dateEntreEnService']."</td>
                    <td>".$array['dateFinService']."</td>
                    <td>".floor(calculateAge($array['dateNaissance']))." ans</td>
                    <td>".floor(calculateAge($array['dateEntreEnService']) * 12)." mois</td>
                    
                    <td class=' flex-row bd-highlight mb-3'>

                        $suppression
                        
                    </td>
                </tr>
        ";
        $content_update = add_update_employe(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['noms_postnoms'], $array['fonction'], $array['phone'], $array['adressemail'], $array['dateNaissance'], $array['dateEntreEnService'], $array['dateFinService'], 'update', $array['idEmployes']);
        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("delete_".$array['idEmployes']."", "Supprimer l employé ".$array['noms_postnoms']."", "Voulez-vous vraiment supprimer cet employé ".$array['noms_postnoms']." qui a l ID : ".$array['idEmployes']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idEmployes']."", 'supprimer') : '';
        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("update_".$array['idEmployes']."", 'Modifier l employé', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idEmployes']."", 'modifier', '', false) : '';
    }
    $content = "
    $recherche
    <div class='horizontal'>
        <table class='table table-bordered'>
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>Nom et post noms</th>
                <th scope='col'>Fonction</th>
                <th scope='col'>Téléphones</th>
                <th scope='col'>Adresse mails</th>
                <th scope='col'>date de naissance</th>
                <th scope='col'>date d entre en service</th>
                <th scope='col'>date de fin de service</th>
                <th scope='col'>Age de l employé</th>
                <th scope='col'>nombre d annee de service</th>
                
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