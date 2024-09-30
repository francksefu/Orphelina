<?php

function add_update_album($urlpost, $type = '', $title = '', $description = '',$addorupdate = 'add', $id = '')
{
    $content = "
    <h2 class='text-secondary m-2 text-center'>$addorupdate file</h2>
    <form method='post' enctype='multipart/form-data' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-10'>
                <div class='mb-3'>
                    <label for='formFile' class='form-label'>Ajouter un fichier</label>
                    <input class='form-control' type='file' name='file' id='formFile'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Titre </span>
                    <input type='text' name='title' class='form-control' value='$title' placeholder='Ecrivez le titre ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div> 
            </div>
        </div>
        
        <div class='col-md-10'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Description</span>
                <textarea name='description'  class='form-control' placeholder='Ecrivez la description ici ...' aria-label='With textarea'>$description</textarea>
            </div>
            <small class='text-danger'></small>
        </div>
        <input type='hidden' name='type' value='$type'>
        <input type='hidden' name='addorupdate' value='$addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <input type='submit' class='btn btn-primary' value='Soumettre'>
    </form>
    ";
    return $content;
}

function images_dossiers($array_images_dossiers)
{
    global $path;
    $content = '';
    if(! empty($array_images_dossiers)) {
        foreach($array_images_dossiers as $array) {
            $delete_button = (isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') ? "<button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idAlbum']."'>
                        Supprimer
                    </button>" : "";
            $see_image_dossier = '';
            $button = '';
            if ($array['type'] == 'album') {
                $see_image_dossier = "<img src='upload_files/".$array['filename']."' class='card-img-top'  alt='".$array['description']."'>";
                $button = "<button type='button' class='btn btn-success m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idAlbum']."'>
                        Voir la photo
                    </button>";
            } else {
                $see_image_dossier = "<img src='dossier.png' class='card-img-top'  alt='".$array['description']."'>";
                $button = "<a class='btn btn-success' target='_blank' href='upload_files/".$array['filename']."' >Voir le dossier</a>";
            }
            $see = "<img src='upload_files/".$array['filename']."' class='card-img-top'  alt='".$array['description']."'>";
            $modal_update = modal("update_".$array['idAlbum']."", 'Modifier le fichier', $see, htmlspecialchars($_SERVER["PHP_SELF"])."?q=".$_GET['q'], 'update', "update_".$array['idAlbum']."", 'modifier', '', false);
            $modal_delete = modal("delete_".$array['idAlbum']."", 'Supprimer le fichier', "Voulez-vous vraiment supprimer le fichier qui a l ID : ".$array['idAlbum']."", htmlspecialchars($_SERVER["PHP_SELF"])."?q=".$_GET['q'], 'delete', "delete_".$array['idAlbum']."", 'supprimer','no', true, "upload_files/".$array['filename']."");
            $content .= "
            <div class='card m-3' style='width: 18rem;'>
                $see_image_dossier
                <div class='card-body'>
                    <h5 class='card-title'>".$array['title']."</h5>
                    <p class='card-text'> ".$array['description']." </p>
                    $button
                    $delete_button
                </div>
            </div>
            $modal_update
            $modal_delete
            ";
            
        } 
    }else {
        $content = "<h2 class='text-secondary text-center'> Pas de fichiers </h2>";
    }
    
    return $content;
}
function voir_enfant($array_of_images = '', $array_of_dossiers = '', $array = '', $flash ='')
{
    $button_add_picture = (isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') ? "
    <button type='button' id='ajouter_album' class='btn btn-primary m-1' data-bs-toggle='modal' data-bs-target='#add_'>
            Ajouter un fichier
        </button>
    " : '';

    $button_add_dossier = (isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') ? "
    <div class=''> <button type='button' id='ajouter_dossier' class='btn btn-primary m-1' data-bs-toggle='modal' data-bs-target='#add_dossier'>
            Ajouter un dossier
        </button> </div>
    " : '';
    $content_add_album = add_update_album(htmlspecialchars($_SERVER['PHP_SELF'])."?q=".$_GET['q'], 'album');
    $content_add_dossier = add_update_album(htmlspecialchars($_SERVER['PHP_SELF'])."?q=".$_GET['q'], 'dossier');
    $modal_add = modal("add_", 'Ajouter un fichier', $content_add_album, htmlspecialchars($_SERVER["PHP_SELF"])."?q=".$_GET['q'], 'add', "add_", 'ajouter', '', false);
    $modal_add_dossier = modal("add_dossier", 'Ajouter un fichier', $content_add_dossier, htmlspecialchars($_SERVER["PHP_SELF"])."?q=".$_GET['q'], 'add_dossier', "add_dossier", 'ajouter', '', false);
    
    $images = images_dossiers($array_of_images);
    $dossiers = images_dossiers($array_of_dossiers);
    $content = "
    $flash
    <div class='border border-secondary p-3 m-3'>
<div class='row'>
    <div class='cart-image-profil col-md-3'> </div>
    <div class='cart-description col-md-7'>
        <div class='border-bottom'>nom : ". $array['nom']."</div>
        <div class='border-bottom'>sexe : ". $array['sexe']."</div>
        <div class='border-bottom'>date de naissance : ". $array['dateNaissance']."</div>
        <div class='border-bottom'>ecole class courant : ". $array['ecoleClassCourant']."</div>
        <div class='border-bottom'>date arrivee : ". $array['dateArrivee']."</div>
        <div class='border-bottom'>age a l'arrivée : ". $array['ageEntree']."</div>
        <div class='border-bottom'>age qu il ou elle a aujourd'hui : nom</div>
        <div class='border-bottom'>Freres et soeurs : ". $array['freres_et_soeurs']."</div>
        <div class='border-bottom'>Histoire : ". $array['histoire']."</div>
        <div class='border-bottom'>Sujet favori : ". $array['sujet_favoris']."</div>
        <div class='border-bottom'>travail : ". $array['travail_de_reve']."</div>
        <div class='border-bottom'>bouf : ". $array['nourriture_favoris']."</div>
        <div class='border-bottom'>hobbies : ". $array['hobbies']."</div>
        <div class='border-bottom'>couleur : ". $array['couleur']."</div>
        <div class='border-bottom'>meilleur ami : ". $array['meilleur_ami']."</div>
        <div class='border-bottom'>talent : ". $array['talent']."</div>
        <div class='border-bottom'>grand reves : ". $array['grand_reves']."</div>
        <div class='border-bottom'>status de reunification : ". $array['status_de_reunification']."</div>
        <div class='border-bottom'>Description sur la reunification : ". $array['description_sur_la_reunification']."</div>
    </div>
</div>
<div class='border-top mt-3'>
    <h3 class='text-secondary'>Album</h3>
    <div class=''> 
        $button_add_picture
    </div>
    <div class='row'>
        $images
    </div>
</div>

<div class='border-top mt-3'>
    <h3 class='text-secondary'>Dossiers</h3>
    $button_add_dossier
    <div class='row'>
        $dossiers
    </div>
</div>
</div>
$modal_add
$modal_add_dossier
    "; 
    return $content;
}

