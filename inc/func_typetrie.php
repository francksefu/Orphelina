<?php
function add_update_type_trie($urlpost, $flash = '', $nom = '', $table_de = '', $addorupdate = 'add', $id = '') {
    $selected_entree = $table_de == 'entrée' ? 'selected' : '';
    $selected_sortie = $table_de == 'sortie' ? 'selected' : '';
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Type de trie</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-8'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Nom </span>
                    <input type='text' name='nom' class='form-control' value='$nom' placeholder='Ecrivez le nom du produit ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                
                
            </div>
        </div>

        <div class='col-md-8'>
            <div class='input-group mb-3'>
                <label class='input-group-text' for='inputGroupSelect01'>Table des :</label>
                <select class='form-select' name='table_de' id='inputGroupSelect01'>
                    <option value='entrée' $selected_entree>Entrée comptabilité</option>
                    <option value='sortie' $selected_sortie>Sortie comptabilité</option>
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

function filter_validate_type_trie( $url = 'type_trie.php')
{
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['nom'] = $nom;
    if($nom === false) {
        $errors['nom'] = 'Le nom doit etre present';
        redirect_with_message('Le nom doit etre present !', FLASH_ERROR, 'type_trie', $url);
    }

    $table_de = filter_input(INPUT_POST, 'table_de', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['table_de'] = $table_de;

    
    
    return ['nom' => $nom, 'table_de' => $table_de];
}