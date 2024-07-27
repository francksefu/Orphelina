<?php flash('produit'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Produit</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nom</th>
        <th scope="col">Description</th>
        <th scope="col">Quantite en stock</th>
        <th scope="col">Prix unitaire</th>
        <th scope="col">Type</th>
        
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idProduit']."</th>
                            <td>".$array['nom']."</td>
                            <td>".$array['description']."</td>
                            <td>".$array['quantiteStock']."</td>
                            <td>".$array['prixUnitaire']."</td>
                            <td>".$array['idTypeProduit']."</td>
                            
                            <td class='row'>
                                <div class='col-1'> </div>
                                <button type='button' class='btn btn-danger col-5 m-1' data-bs-toggle='modal' data-bs-target='#delete_".$array['idProduit']."'>
                                    Supprimer
                                </button>

                                <button type='button' class='btn btn-warning col-5 m-1' data-bs-toggle='modal' data-bs-target='#update_".$array['idProduit']."'>
                                    Modifier
                                </button>
                                
                            </td>
                        </tr>
                ";
                $content_update = add_update_produit(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['nom'], $array['quantiteStock'], $array['description'], $array['prixUnitaire'], 'update', $array['idProduit']);
                echo modal("delete_".$array['idProduit']."", "Supprimer le produit ".$array['nom']."", "Voulez-vous vraiment supprimer le produit ".$array['nom']." qui a l ID : ".$array['idProduit']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idProduit']."", 'supprimer');
                echo modal("update_".$array['idProduit']."", 'Modifier le produit', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idProduit']."", 'modifier', '', false);
                echo $line;
            }
        ?>
        
    </tbody>
</table>
<!-- Button trigger modal -->


<?php
    
?>
</main>