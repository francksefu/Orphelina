<?php flash('comptabilite'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center"><?php echo $_GET['q'] ?></h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> USD</small></div>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Montant</th>
        <th scope="col">Motif</th>
        <th scope="col">Date</th>
        <th scope="col">Date et heure de l enregistrement</th>
        <th scope="col">Type</th>
        
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idComptabilite']."</th>
                            <td>".$array['montant']."</td>
                            <td>".$array['motif']."</td>
                            <td>".$array['Date']."</td>
                            <td>".$array['heure']."</td>
                            <td>".$array['idTypeTrie']."</td>
                            
                            <td class='row'>
                                <div class='col-1'> </div>
                                <button type='button' class='btn btn-danger col-5 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idComptabilite']."'>
                                    Supprimer
                                </button>

                                <button type='button' class='btn btn-warning col-5 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idComptabilite']."'>
                                    Modifier
                                </button>
                                
                            </td>
                        </tr>
                ";
                $content_update = add_update_comptabilite(htmlspecialchars($_SERVER['PHP_SELF']), $_GET['q'], $array['Date'], $array['montant'], $array['motif'], $array['Nfacture'], '', 'update', $array['idComptabilite']);
                echo modal("delete_".$array['idComptabilite']."", 'Supprimer element', "Voulez-vous vraiment supprimer l' element qui a l ID : ".$array['idComptabilite']."", htmlspecialchars($_SERVER["PHP_SELF"]).'?q='.$_GET['q'], 'delete', "delete_".$array['idComptabilite']."", 'supprimer', $_GET['q']);
                echo modal("update_".$array['idComptabilite']."", 'Modifier element', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idComptabilite']."", 'modifier', $_GET['q'], false);
                echo $line;
            }
        ?>
        
    </tbody>
</table>
<!-- Button trigger modal -->


<?php
    
?>
</main>