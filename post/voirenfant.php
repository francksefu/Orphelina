<?php
    $array = filter_validate_voirenfant();
    $filename = $array['filename'];
    $path = $array['path'];
    $description = $array['description'];
    $idEnfant = $array['idEnfant'];
    $size = $array['size'];
    $title = $array['title'];
    $type = $array['type'];
    $id = $array['id'];
    $url = $array['url'];
    $addorupdate = $array['addorupdate'];
    $album = new Album();
    if ($filename && $size && $idEnfant) {
        if($addorupdate == 'add') {
            if ($album->insert($filename, $path, $description, $idEnfant, $size, $type, $title)) {
                redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'voirenfant', $url);
            }
        } elseif($addorupdate == 'update') {
            if ($album->insert($filename, $path, $description, $idEnfant, $size, $title, $type, $id)) {
                redirect_with_message('Modification fait avec success !', FLASH_SUCCESS, 'voirenfant', $url);
            }
        }
        
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'voirenfant', $url);
    }

    

