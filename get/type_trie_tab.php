<?php flash('type_trie'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Type de trie</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
<div class='horizontal'>
<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nom</th>
        <th scope="col">Table de </th>
        
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody id='tbody'>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idTypeTrie']."</th>
                            <td>".$array['name']."</td>
                            <td>".$array['table_de']." comptabilité</td>
                            
                            <td class='row'>
                                <div class='col-1'> </div>
                                <button type='button' class='btn btn-danger m-1 col-md-5' data-bs-toggle='modal' data-bs-target='#delete_".$array['idTypeTrie']."'>
                                    Supprimer
                                </button>

                                <button type='button' class='btn btn-warning m-1 col-md-5' data-bs-toggle='modal' data-bs-target='#update_".$array['idTypeTrie']."'>
                                    Modifier
                                </button>
                                
                            </td>
                        </tr>
                ";
                $content_update = add_update_type_trie(htmlspecialchars($_SERVER['PHP_SELF']), '', $array['name'], $array['table_de'], 'update', $array['idTypeTrie']);
                echo modal("delete_".$array['idTypeTrie']."", "Supprimer le type de trie ".$array['name']."", "Voulez-vous vraiment supprimer le type de trie ".$array['name']." qui a l ID : ".$array['idTypeTrie']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idTypeTrie']."", 'supprimer');
                echo modal("update_".$array['idTypeTrie']."", 'Modifier le type de trie', $content_update, htmlspecialchars($_SERVER["PHP_SELF"]), 'update', "update_".$array['idTypeTrie']."", 'modifier', '', false);
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