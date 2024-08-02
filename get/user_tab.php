<?php flash('user'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Utilisateurs</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
<div class='horizontal'>
<table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nom de l utilisateur</th>
        <th scope="col">Poste </th>
        <th scope="col">Etat </th>
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody id='tbody'>
        <?php
            
            foreach($default_array as $array) {
                $line = "
                        <tr>
                            <th>".$array['idUser']."</th>
                            <td>".$array['username']."</td>
                            <td>".$array['post']."</td>
                            <td>".$array['state']." </td>
                            
                            <td class='row'>
                                <div class='col-1'> </div>
                                <button type='button' class='btn btn-danger m-1 col-md-5' data-bs-toggle='modal' data-bs-target='#delete_".$array['idUser']."'>
                                    Supprimer
                                </button>
                                
                            </td>
                        </tr>
                ";
                echo modal("delete_".$array['idUser']."", "Supprimer l utilisateur ".$array['username']."", "Voulez-vous vraiment supprimer l utilisateur ".$array['username']." qui a l ID : ".$array['idUser']."", htmlspecialchars($_SERVER["PHP_SELF"]), 'delete', "delete_".$array['idUser']."", 'supprimer');

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