<?php
function add_update_comptabilite($urlpost, $type, $date , $value_montant = '', $value_motif = '', $value_Nfacture = '', $idTypeTrie = '', $flash = '', $addorupdate = 'add', $id = '') {
    global $array_of_type_trie;
    $type_trie = '';
    $selected = '';
    foreach($array_of_type_trie as $typetrie) {
        if(! empty($idTypeTrie)) {
            $selected = $idTypeTrie == $typetrie['idTypeTrie'] ? 'selected' : '';
        }
        $type_trie .= "<option value='".$typetrie['idTypeTrie']."' $selected>".$typetrie['name']."</option>";
    }
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>$type</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-6'></div>
            <div class='col-md-6'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>N facture </span>
                    <input type='text' class='form-control' value='$value_Nfacture' readonly placeholder='number of facture here : generete its self' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Date</span>
                    <input required type='date' name='date' value='$date' class='form-control' placeholder='facture' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>
                
            </div>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Montant</span>
                <input required type='float' value='$value_montant' name='montant' step='0.001' placeholder='Ecrivez le montant ici' class='form-control number' aria-label='Amount (to the nearest dollar)'>
                <span class='input-group-text'>USD</span>
            </div>
            <small class='text-danger number-text'></small>
        </div>
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Motif</span>
                <textarea required name='motif'  class='form-control' placeholder='Ecrivez le motif ici ...' aria-label='With textarea'>$value_motif</textarea>
            </div>
            <small class='text-danger'></small>
        </div>

        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <label class='input-group-text' for='inputGroupSelect01'>Type</label>
                <select class='form-select' name='idTypeTrie' value='$idTypeTrie' id='inputGroupSelect01'>
                    $type_trie
                </select>
            </div>
            <small class='text-danger'></small>
        </div>
        <input type='hidden' name='type' value='$type'>
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' id='submit' class='btn btn-primary' value='Soumettre une $type'>
    </form>";
    return $content;
}

function filter_validate_comptabilite( $url = 'comptabilite.php?q=')
{
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['type'] = $type;
    $url = $url . $type;
    if($type === false) {
        $errors['type'] = 'Mauvais type';
        redirect_with_message('Mauvais type !', FLASH_ERROR, 'comptabilite', $url);
    }

    $montant = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input['montant'] = $montant;
    if ($montant !== false && $montant !== null) {
        $montant = filter_var($montant, FILTER_VALIDATE_FLOAT, ['options' => ['min_range'=> 0]]);
    }

    if($montant === false) {
        $errors['montant'] = 'Le montant doit etre present';
        redirect_with_message('Le montant doit etre present et different de 0', FLASH_ERROR, 'comptabilite', $url);
    }

    $motif = filter_input(INPUT_POST, 'motif', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['motif'] = $motif;

    if($motif === false) {
        $errors['motif'] = 'Le motif doit etre present';
        redirect_with_message('Le motif doit etre present', FLASH_ERROR, 'comptabilite', $url);
    }

    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['date'] = $date;
    $idTypeTrie = filter_input(INPUT_POST, 'idTypeTrie', FILTER_SANITIZE_SPECIAL_CHARS);

    if($date === false) {
        $errors['date'] = 'La date doit etre presente';
        redirect_with_message('La date doit etre presente', FLASH_ERROR, 'comptabilite', $url);
    }
    if (! empty($Nfacture)) {

    } else {
        $Nfacture = new DateTime();
        $Nfacture = $Nfacture->format('Y-m-d H:i:s');
        $pattern = '/\d/';
        if(preg_match_all($pattern, $Nfacture, $matches)) {
            $Nfacture = implode($matches[0]);
        }
    }
    return ['type' => $type, 'montant' => $montant, 'motif' => $motif, 'date' => $date, 'Nfacture' => $Nfacture, 'idTypeTrie' => $idTypeTrie];

}

function comptabilite_tab($default_array) {
    $recherche = recherche_dans_tableau();
    
    $line = '';
    foreach($default_array as $array) {
        $suppression = (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? "<div class='col-1'> </div>
                        <button type='button' class='btn btn-danger col-md-5 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idComptabilite']."'>
                            Supprimer
                        </button>

                        <button type='button' class='btn btn-warning col-md-5 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idComptabilite']."'>
                            Modifier
                        </button>" : '';
        $line .= "
                <tr>
                    <th>".$array['idComptabilite']."<br><a class='btn btn-success' target='_blank' href='generatepdf.php?q=".$array['idComptabilite']."' >Imprimer facture</a></th>
                    <td>".$array['montant']."</td>
                    <td>".$array['motif']."</td>
                    <td>".$array['Date']."</td>
                    <td>".$array['heure']."</td>
                    <td>".$array['name']."</td>
                    
                    <td class='row'>
                        $suppression
                    </td>
                </tr>
        ";
        $content_update = add_update_comptabilite(htmlspecialchars($_SERVER['PHP_SELF']), $_GET['q'], $array['Date'], $array['montant'], $array['motif'], $array['Nfacture'], $array['idTypeTrie'], '', 'update', $array['idComptabilite']);
        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ?  modal("delete_".$array['idComptabilite']."", 'Supprimer element', "Voulez-vous vraiment supprimer l' element qui a l ID : ".$array['idComptabilite']."", htmlspecialchars($_SERVER["PHP_SELF"]).'?q='.$_GET['q'], 'delete', "delete_".$array['idComptabilite']."", 'supprimer', $_GET['q']) : '';
        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("update_".$array['idComptabilite']."", 'Modifier element', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idComptabilite']."", 'modifier', $_GET['q'], false) : '';
    }
    $content = "
    $recherche
    <div class='horizontal'>
<table class='table table-bordered'>
    <thead>
        <tr>
        <th scope='col'>id</th>
        <th scope='col'>Montant</th>
        <th scope='col'>Motif</th>
        <th scope='col'>Date</th>
        <th scope='col'>Date et heure de l enregistrement</th>
        <th scope='col'>Type</th>
        
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