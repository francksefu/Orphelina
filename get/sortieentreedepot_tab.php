<?php flash('sortieentreedepot');?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center"><?php echo $_GET['q'] ?> depot</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>

<?php
foreach($default_array as $array) {
    $line = '';
    $contenu = '';
    foreach($array['data_content'] as $array_product_quantity) {
        $prod_sortie_entree = $produit->read($array_product_quantity['idProduit'])[0];
        $line .= "
            <tr>
                <th>".$array_product_quantity['idSortieEntree']."</th>
                <td>".$prod_sortie_entree['nom']."</td>
                <td>".$array_product_quantity['quantite']."  ".$prod_sortie_entree['unite_mesure']."</td>
            </tr>
                ";
    }
    $contenu .= "
        <div class='row'>
        <div class='col-md-2'> </div>
        <div class='border border-secondary p-3 col-md-8'>
            <div class='border-bottom pb-3'>facture : ".$array['Nfacture']."</div>
            <div class='border-bottom pb-3'>Date : ".$array['Date']."<div>
            <div class='border border-bottom pb-3'>Date et heure d enregistrement : ".$array['heure']."</div>
            <div class='row border-bottom'>
                <div class='border-bottom pb-3 col-md-3'>Note :</div>
                <p class=' col-md-7'> ".$array['note']."</p>
            </div>
            <div class='row border-bottom'>
                <div class=' col-md-3'> Actions</div>
                <button type='button' class='btn btn-danger col-md-2 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['Nfacture']."'>
                        Supprimer
                    </button>

                    <button type='button' class='btn btn-warning col-md-2 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['Nfacture']."'>
                        Modifier
                    </button>
                <div class='row' col-md-7>
                    
                    
                </div>
            </div>
        </div>

        <table class='table table-bordered'>
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>Nom du produit</th>
                <th scope='col'>Quantite ".$_GET['q']."</th>
                </tr>
            </thead>
            <tbody>
                $line
            </tbody>
        </table>
        <div class='col-md-2'> </div>
        </div>
        ";
        $content_update = add_update_sortieentree(htmlspecialchars($_SERVER['PHP_SELF']), $_GET['q'], $array['Date'], $array_of_product, $array['note'], json_encode($array['data_content']), $array['Nfacture'], '', 'update');
        echo modal("delete_".$array['Nfacture']."", 'Supprimer element', "Voulez-vous vraiment supprimer la facture d ".$_GET['q']." qui a le numero : ".$array['Nfacture']."", htmlspecialchars($_SERVER["PHP_SELF"]).'?q='.$_GET['q'], 'delete', "delete_".$array['Nfacture']."", 'supprimer', $_GET['q']);
        echo modal("update_".$array['Nfacture']."", 'Modifier element', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['Nfacture']."", 'modifier', $_GET['q'], false);
        echo $contenu;
}

?>

</main>