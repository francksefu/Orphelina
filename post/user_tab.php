<?php

if (isset($_POST['delete'])) {
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['delete'] = $delete;

    if($delete === false) {
        $errors['delete'] = 'Impossible de supprimer';
        redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'user', "user_tab.php");
    }
    $idUser = explode('_', $delete)[1];
    $user = new User();
    if ($user->delete((int) $idUser)) {
        redirect_with_message('Suppression effectuer avec success', FLASH_SUCCESS, 'user', "user_tab.php");
    } else {
        redirect_with_message('Erreur : La suppression n a pas etre effectuer', FLASH_ERROR, 'user', "user_tab.php");
    }

}