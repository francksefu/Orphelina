<?php
    session_start();
    require __DIR__.'/../inc/func_voirenfant.php';
    require __DIR__.'/../inc/flash.php';
    require_once __DIR__.'/../features/Album.php';
    require_once __DIR__.'/../features/Child.php';
    require __DIR__.'/../inc/header.php';
    $path = __DIR__.'/../upload_files/2023-04-25_104501.png';
    require_login();
    $errors = [];
    $inputs = [];
    $valid = false;
    $enfant = new Enfant();
    $album = new Album();
    $enfant_trouve = $enfant->read($_GET['q'])[0];
    $enfant_album = $album->read($_GET['q'], 'album');
    $enfant_dossier = $album->read($_GET['q'], 'dossier');
    $request_method = strtoupper($_SERVER["REQUEST_METHOD"]);
    if($request_method === 'GET') {
        require __DIR__.'/../get/voirenfant.php';
    } elseif ($request_method === 'POST') {
        require __DIR__.'/../post/voirenfant.php';
        header('Location: voirenfant.php', true, 303);
        exit;
    }
    require __DIR__.'/../inc/footer.php';

function filter_validate_voirenfant( $url = 'voirenfant.php?q=')
{
    $url = $url . $_GET['q'];
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($_POST['delete'])) {
        $delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
        $input['delete'] = $delete;
        $filepathtodelete = filter_input(INPUT_POST, 'filepathtodelete', FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($filepathtodelete)) {
            $errors['delete'] = 'Impossible de supprimer';
            redirect_with_message('File path probleme', FLASH_ERROR, 'voirenfant', $url);
        }
        if($delete === false) {
            $errors['delete'] = 'Impossible de supprimer';
            redirect_with_message('Impossible de supprimer', FLASH_ERROR, 'voirenfant', $url);
        }
        $idAlbum = explode('_', $delete)[1];
        $album = new Album();
        $text = 'There was a error deleting the file ' . $filepathtodelete;
        if ($album->delete((int) $idAlbum)) {
            
            if (unlink($filepathtodelete)) {
                $text = 'The file ' . $filepathtodelete . ' was deleted successfully!';
            } else {
                $text = 'There was a error deleting the file ' . $filepathtodelete;
            }
            redirect_with_message("Suppression effectuer avec success et $text", FLASH_SUCCESS, 'voirenfant', $url);
        } else {
            redirect_with_message("Erreur : La suppression n a pas etre effectuer et $text", FLASH_ERROR, 'voirenfant', $url);
        }
    
    }

    $idEnfant = $_GET['q'];
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['type'] = $type;
    if($type === false) {
        $errors['type'] = 'Mauvais type';
        redirect_with_message('Mauvais type !', FLASH_ERROR, 'voirenfant', $url);
    }
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['title'] = $title;

    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['description'] = $description;

    $addorupdate = filter_input(INPUT_POST, 'addorupdate', FILTER_SANITIZE_SPECIAL_CHARS);
    
    

    //

     $MAX_SIZE = 50 * 1024 * 1024; //  50MB

    $UPLOAD_DIR = __DIR__ . '/upload_files';
    if (isset($_FILES['file'])) {
        $status = $_FILES['file']['error'];
        $filename = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
    
    
        // an error occurs
        if ($status !== UPLOAD_ERR_OK) {
            redirect_with_message('Une erreur s est produite lors de l enregistrement du fichier', FLASH_ERROR, 'voirenfant', $url);
        }
    
        // validate the file size
        $filesize = filesize($tmp);
        if ($filesize > $MAX_SIZE) {
            redirect_with_message("Votre fichier est tres lourd, chercher un autre plus leger qui ne depasse pas $MAX_SIZE", FLASH_ERROR, 'voirenfant', $url);
        }
    
        // set the filename as the basename + extension
        $uploaded_file = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        // new file location
        $filepath = $UPLOAD_DIR . '/' . $uploaded_file . ".$extension";
        $f = '';
        if (is_uploaded_file($tmp)) {
            $f .= "The file is a valid uploaded file.";
        } else {
            $f .=  "The file is not a valid uploaded file.";
        }
        
        if (is_writable($UPLOAD_DIR)) {
            $f .=  "The upload directory is writable.";
        } else {
            $f .= "The upload directory is not writable.";
        }
            // move the file to the upload dir
        $success = move_uploaded_file($tmp, $filepath);
        if (! $success) {
            redirect_with_message("$f <br>   The file was not uploaded .", FLASH_ERROR, 'voirenfant', $url);
        }
        
        return ['filename' => $filename, 'path' => $filepath, 'description' => $description, 'idEnfant' => $idEnfant, 'size' => $filesize, 'title' => $title, 'type' => $type, 'addorupdate' => $addorupdate, 'url' => $url, 'id' => $id];
    
    } else {
        redirect_with_message('Invalid file upload operation', FLASH_ERROR, 'voirenfant', $url);
    }
    
}