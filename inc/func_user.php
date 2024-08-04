<?php
function add_update_user($urlpost, $flash = '', $username = '', $password = '', $post = '' , $etat = '', $addorupdate = 'add', $id = '') {
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Utilisateur</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-6'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Nom d utilisateur </span>
                    <input required type='text' name='username' class='form-control' value='$username' placeholder='Ecrivez le nom de l utilisateur ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Mot de passe </span>
                    <input required type='password' name='password' class='form-control' value='$password' placeholder='Ecrivez le mot de passe ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <label class='input-group-text' for='inputGroupSelect01'>Post</label>
                    <select class='form-select' name='post' id='inputGroupSelect01'>
                        <option value='administrateur'>administrateur</option>
                        <option value='comptable'>comptable</option>
                        <option value='magazinien ou depot'>magazinien ou depot</option>
                        <option value='directeur'>directeur</option>
                    </select>
                </div>

                <div class='input-group mb-3'>
                    <label class='input-group-text' for='inputGroupSelect01'>Langue</label>
                    <select class='form-select' name='post' id='inputGroupSelect01'>
                        <option value='francais'>francais</option>
                        <option value='anglais'>anglais</option>
                    </select>
                </div>
                
            </div>
        </div>
        
        <div class='col-md-6'>
            <div class='input-group mb-3'>
                <label class='input-group-text' for='inputGroupSelect01'>Type</label>
                <select class='form-select' name='state' id='inputGroupSelect01'>
                    <option value='actif'>actif</option>
                    <option value='inactif'>inactif</option>
                </select>
            </div>
            <small class='text-danger'></small>
        </div>
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre'>
    </form>";
    return $content;
}

function filter_validate_user( $url = 'user.php')
{
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if($username === false) {
        redirect_with_message('Le nom de l utilisateur doit etre present !', FLASH_ERROR, 'user', $url);
    }

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if($password === false) {
        redirect_with_message('Le mot de passe de l utilisateur doit etre present !', FLASH_ERROR, 'user', $url);
    }

    $post = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if($post === false) {
        redirect_with_message('Le post de l utilisateur doit etre present !', FLASH_ERROR, 'user', $url);
    }

    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS);
    
    return ['username' => $username, 'password' => $password, 'post' => $post, 'state' => $state];
}