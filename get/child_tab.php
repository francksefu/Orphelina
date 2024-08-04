<?php flash('child'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center"><?php echo tr('Enfant'); ?></h2>
    <?php echo child_tab($default_array, $total) ?>
<!-- Button trigger modal -->


<?php
   function child_tab($default_array, $total = '') {
    $line = '';
    
    foreach($default_array as $array) {
        $suppression =(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? "
                        <button type='button' class='btn btn-danger p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#delete_".$array['idEnfant']."'>
                            Supprimer
                        </button>

                        <button type='button' class='btn btn-warning p-2 m-1 bd-highlight' data-bs-toggle='modal' data-bs-target='#update_".$array['idEnfant']."'>
                            Modifier
                        </button>" : '';
                        $content_update = add_update_child(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['nom'], $array['sexe'], $array['dateNaissance'], $array['ecoleClassCourant'], $array['dateArrivee'], $array['ageEntree'], $array['freres_et_soeurs'], $array['histoire'], $array['sujet_favoris'], $array['travail_de_reve'], $array['nourriture_favoris'], $array['hobbies'], $array['couleur'], $array['meilleur_ami'], $array['talent'], $array['grand_reves'], $array['traits_interessant'], $array['status_de_reunification'], $array['description_sur_la_reunification'], $array['date_de_reunification'], 'update', $array['idEnfant']);
                        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("delete_".$array['idEnfant']."", "Supprimer l enfant ".$array['nom']."", "Voulez-vous vraiment supprimer cet enfant ".$array['nom']." qui a l ID : ".$array['idEnfant']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idEnfant']."", 'supprimer') : '';
                        $line .= (isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') ? modal("update_".$array['idEnfant']."", 'Modifier l enfant', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idEnfant']."", 'modifier', '', false) : '';
        
        $line .= "
                <tr>
                    <th>".$array['idEnfant']."</th>
                    <td>".$array['nom']." <br> <a href='voirenfant.php?q=".$array['idEnfant']."' class='btn btn-success m-2'> Voir</a> </td>
                    <td>".$array['sexe']."</td>
                    <td>".$array['dateNaissance']."</td>
                    <td>".$array['ecoleClassCourant']."</td>
                    <td>".$array['dateArrivee']."</td>
                    <td>".$array['ageEntree']."</td>
                    <td>".$array['freres_et_soeurs']."</td>
                    <td>".$array['histoire']."</td>
                    <td>".$array['sujet_favoris']."</td>
                    <td>".$array['travail_de_reve']." </td>
                    <td>".$array['nourriture_favoris']."</td>
                    <td>".$array['hobbies']."</td>
                    <td>".$array['couleur']."</td>
                    <td>".$array['meilleur_ami']."</td>
                    <td>".$array['talent']."</td>
                    <td>".$array['grand_reves']."</td>
                    <td>".$array['traits_interessant']."</td>
                    <td>".$array['status_de_reunification']."</td>
                    <td>".$array['description_sur_la_reunification']."</td>
                    <td>".$array['date_de_reunification']."</td>
                    
                    <td class='bd-highlight mb-3'>
                        $suppression
                    </td>
                </tr>
        ";
        
    }
        $content = "
        <div class='row'>
        <div class='col-md-7'></div>
        <div class='col-md-4'><small>total :  $total  </small></div>
    </div>
    ".recherche_dans_tableau()."
<div class='horizontal'>
<table class='table table-bordered' >
    <thead>
        <tr>
        <th scope='col'>id</th>
        <th scope='col'>".tr('Nom')."</th>
        <th scope='col'>Sexe</th>
        <th scope='col'>".tr('Date de naissance')."</th>
        <th scope='col'>".tr('annee d ecole')."</th>
        <th scope='col'>".tr('Date d arrivee')."</th>
        <th scope='col'>".tr('Age à l entrée')."</th>
        <th scope='col'>".tr('Siblings at home?')."</th>
        <th scope='col'>".tr('Arriere-plan')."</th>
        <th scope='col'>".tr('Sujet favori')."</th>
        <th scope='col'>".tr('Quel est le travail de tes reves?')."</th>
        <th scope='col'>".tr('Nourriture favorite')."</th>
        <th scope='col'>".tr('Passe-temps')."</th>
        <th scope='col'>".tr('Couleur')."</th>
        <th scope='col'>".tr('Meilleur ami')."</th>
        <th scope='col'>Talents</th>
        <th scope='col'>".tr('Quel est ton plus grand reve ou souhait?')."</th>
        <th scope='col'>".tr('Fait ou caracter interessant sur l enfant')."</th>
        <th scope='col'>".tr('Status de reunification')."</th>
        <th scope='col'>".tr('Description sur la reunification')."</th>
        <th scope='col'>".tr('Date de reunification')."</th>
        
        <th scope='col'>action</th>
        </tr>
    </thead>
    <tbody id='tbody'>
        $line
    </tbody>
</table>
</div>
        ";
    return $content;
   } 
?>
</main>