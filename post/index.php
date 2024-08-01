<?php
$username = $post = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $post = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

if (!login($username, $password)) {

    $errors['login'] = 'Invalid username or password';

    redirect_with_message('Invalid username or password', FLASH_ERROR, 'index', "index.php");
}
redirect_with_message('Vous etes maintenant connecté', FLASH_SUCCESS, 'home', "home.php");

function login(string $username, string $password): bool
{
    global $users;
    $user = $users->find_user_by_username($username);

    // if user found, check the password
    if ($user && password_verify($password, $user['password'])) {

        // prevent session fixation attack
        session_regenerate_id();

        // set username in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id']  = $user['id'];


        return true;
    }

    return false;
}