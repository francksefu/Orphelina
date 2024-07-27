<?php
function add_update_comptabilite($urlpost, $type, $date , $value_montant = '', $value_motif = '', $value_Nfacture = '', $flash = '', $addorupdate = 'add', $id = '') {
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
                <input required type='float' value='$value_montant' name='montant' step='0.001' placeholder='Ecrivez le montant ici' class='form-control' aria-label='Amount (to the nearest dollar)'>
                <span class='input-group-text'>USD</span>
            </div>
            <small class='text-danger'></small>
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
                <select class='form-select' id='inputGroupSelect01'>
                    <option selected>Choose...</option>
                    <option value='1'>One</option>
                    <option value='2'>Two</option>
                    <option value='3'>Three</option>
                </select>
            </div>
            <small class='text-danger'></small>
        </div>
        <input type='hidden' name='type' value='$type'>
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre une $type'>
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
    return ['type' => $type, 'montant' => $montant, 'motif' => $motif, 'date' => $date, 'Nfacture' => $Nfacture];

}