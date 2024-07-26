<?php
const FLASH = 'FLASH_MESSAGES';

const FLASH_ERROR = 'danger';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

/**
 * Create a flash message
 *
 * @param string $name
 * @param string $message
 * @param string $type
 * @return void
 */
function create_flash_message(string $name, string $message, string $type): void
{
    // remove existing message with the name
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    // add the message to the session
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}


/**
 * Format a flash message
 *
 * @param array $flash_message
 * @return string
 */
function format_flash_message(array $flash_message): string
{
    return sprintf('<div class="alert alert-%s">%s</div>',
        $flash_message['type'],
        $flash_message['message']
    );
}

/**
 * Display a flash message
 *
 * @param string $name
 * @return void
 */
function display_flash_message(string $name): void
{
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    // get message from the session
    $flash_message = $_SESSION[FLASH][$name];

    // delete the flash message
    unset($_SESSION[FLASH][$name]);

    // display the flash message
    echo format_flash_message($flash_message);
}

/**
 * Display all flash messages
 *
 * @return void
 */
function display_all_flash_messages(): void
{
    if (!isset($_SESSION[FLASH])) {
        return;
    }

    // get flash messages
    $flash_messages = $_SESSION[FLASH];

    // remove all the flash messages
    unset($_SESSION[FLASH]);

    // show all flash messages
    foreach ($flash_messages as $flash_message) {
        echo format_flash_message($flash_message);
    }
}

/**
 * Flash a message
 *
 * @param string $name
 * @param string $message
 * @param string $type (error, warning, info, success)
 * @return void
 */
function flash(string $name = '', string $message = '', string $type = ''): void
{
    if ($name !== '' && $message !== '' && $type !== '') {
        // create a flash message
        create_flash_message($name, $message, $type);
    } elseif ($name !== '' && $message === '' && $type === '') {
        // display a flash message
        display_flash_message($name);
    } elseif ($name === '' && $message === '' && $type === '') {
        // display all flash message
        display_all_flash_messages();
    }
}

function getCurrentUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    return $protocol . $host . $requestUri;
}

function redirect_with_message(string $message, string $type=FLASH_ERROR, string $name='upload', string $location='index.php'): void
{
    flash($name, $message, $type);
    header("Location: $location", true, 303);
    exit;
}

function modal($id, $modaltitle, $modalbody, $linkaction, $namepost, $valuepost, $buttonname, $type='no', $delete = true)
{
    if ($delete) {
        $type_modal = "
        <form method='post' action='$linkaction' class='col-5'>
            <input type='hidden' name='$namepost' value='$valuepost' >
            <input type='hidden' name='type' value='$type' >
            <input type='submit' class='btn btn-primary' value='$buttonname'>
        </form>
    ";
    } else {
        $type_modal = "";
    }
    
    $content = "
    <div class='modal fade' id='$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>$modaltitle</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            $modalbody
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            $type_modal
          </div>
        </div>
      </div>
    </div>";
    return $content;
}

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