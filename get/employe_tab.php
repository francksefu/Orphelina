<?php flash('employe'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Employés</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nom et post noms</th>
        <th scope="col">Fonction</th>
        <th scope="col">Téléphones</th>
        <th scope="col">Adresse mails</th>
        <th scope="col">date de naissance</th>
        <th scope="col">date d entre en service</th>
        <th scope="col">date de fin de service</th>
        <th scope="col">Age de l employé</th>
        <th scope="col">nombre d annee de service</th>
        
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idEmployes']."</th>
                            <td>".$array['noms_postnoms']."</td>
                            <td>".$array['fonction']."</td>
                            <td>".$array['phone']."</td>
                            <td>".$array['adressemail']."</td>
                            <td>".$array['dateNaissance']."</td>
                            <td>".$array['dateEntreEnService']."</td>
                            <td>".$array['dateFinService']."</td>
                            <td>".floor(calculateAge($array['dateNaissance']))." ans</td>
                            <td>".floor(calculateAge($array['dateEntreEnService']) * 12)." mois</td>
                            
                            <td class='row'>
                                <div class='col-1'> </div>
                                <button type='button' class='btn btn-danger col-5 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idEmployes']."'>
                                    Supprimer
                                </button>

                                <button type='button' class='btn btn-warning col-5 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idEmployes']."'>
                                    Modifier
                                </button>
                                
                            </td>
                        </tr>
                ";
                $content_update = add_update_employe(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['noms_postnoms'], $array['fonction'], $array['phone'], $array['adressemail'], $array['dateNaissance'], $array['dateEntreEnService'], $array['dateFinService'], 'update', $array['idEmployes']);
                echo modal("delete_".$array['idEmployes']."", "Supprimer l employé ".$array['noms_postnoms']."", "Voulez-vous vraiment supprimer cet employé ".$array['noms_postnoms']." qui a l ID : ".$array['idEmployes']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idEmployes']."", 'supprimer');
                echo modal("update_".$array['idEmployes']."", 'Modifier l employé', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idEmployes']."", 'modifier', '', false);
                echo $line;
            }
        ?>
        
    </tbody>
</table>
<!-- Button trigger modal -->


<?php
    
?>
</main>