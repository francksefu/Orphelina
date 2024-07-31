<?php flash('employe'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Enfant</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
    <?php echo recherche_dans_tableau(); ?>
<div class='horizontal'>
<table class="table table-bordered" style="width: 150%">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nom et post noms</th>
        <th scope="col">Sexe</th>
        <th scope="col">Date d arrivée</th>
        <th scope="col">Age a l arrivée</th>
        <th scope="col">Parents</th>
        <th scope="col">Provenance</th>
        <th scope="col">Objet de referencement</th>
        <th scope="col">Observation a l arrivée</th>
        <th scope="col">Status de reunification</th>
        <th scope="col">Description sur la reunification</th>
        <th scope="col">Date de reunification</th>
        
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody id='tbody'>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idEnfant']."</th>
                            <td>".$array['noms_postnoms']." <br> <a href='voirenfant.php?q=".$array['idEnfant']."' class='btn btn-success m-2'> Voir</a> </td>
                            <td>".$array['sexe']."</td>
                            <td>".$array['dateArrivee']."</td>
                            <td>".$array['age']."</td>
                            <td>".$array['parents']."</td>
                            <td>".$array['provenance']."</td>
                            <td>".$array['objetDeReferencement']."</td>
                            <td>".$array['observation_a_l_arrivee']." </td>
                            <td>".$array['status_de_reunification']."</td>
                            <td>".$array['description_sur_la_reunification']."</td>
                            <td>".$array['date_de_reunification']."</td>
                            
                            <td class='row'>
                                <div class='col-md-1'> </div>
                                <button type='button' class='btn btn-danger col-md-5 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idEnfant']."'>
                                    Supprimer
                                </button>

                                <button type='button' class='btn btn-warning col-md-5 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idEnfant']."'>
                                    Modifier
                                </button>
                                
                            </td>
                        </tr>
                ";
                $content_update = add_update_enfant(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['noms_postnoms'], $array['sexe'], $array['dateArrivee'], $array['age'], $array['parents'], $array['provenance'], $array['objetDeReferencement'], $array['observation_a_l_arrivee'], $array['status_de_reunification'], $array['description_sur_la_reunification'], $array['date_de_reunification'], 'update', $array['idEnfant']);
                echo modal("delete_".$array['idEnfant']."", "Supprimer l enfant ".$array['noms_postnoms']."", "Voulez-vous vraiment supprimer cet enfant ".$array['noms_postnoms']." qui a l ID : ".$array['idEnfant']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idEnfant']."", 'supprimer');
                echo modal("update_".$array['idEnfant']."", 'Modifier l enfant', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idEnfant']."", 'modifier', '', false);
                echo $line;
            }
        ?>
        
    </tbody>
</table>
</div>
<!-- Button trigger modal -->


<?php
    
?>
</main>