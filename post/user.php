<?php
    
    $array = filter_validate_user();
    $username = $array['username'];
    $password = $array['password'];
    $post = $array['post'];
    $state = $array['state'];
    $user = new User();
    if ($username && $password ) {
        if ($user->insert($username, password_hash($password, PASSWORD_BCRYPT), $post, $state)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'user', "user.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'user', "user.php");
    }
    
    

