<?php
function add_update_sortieentree($urlpost, $type, $date ,$array_of_product , $value_note = '', $array_of_product_and_quantity = '', $value_Nfacture = '', $flash = '', $addorupdate = 'add', $id = '') {
    $line_quantity = '';
    
    if(! empty($array_of_product_and_quantity)) {
        $arr_p_q = json_decode($array_of_product_and_quantity, true);
        foreach($arr_p_q as $product_quantity) {
            foreach($array_of_product as $product) {
                if($product_quantity['idProduit'] == $product['idProduit']) {
                    $line_quantity .= "<tr class='line_show'><td>".$product_quantity['idProduit']."</td><td>".$product['nom']."</td><td>" .$product_quantity['quantite']. "</td><td> <a href='#' class='btn btn-danger supprime'> Supprimer </a> </td></tr>";
                    break;
                }
            }
        }
    }
    $line = '';
    $array_of_product_in_json = json_encode($array_of_product);
    $width = $addorupdate !== 'add' ? 10 : 6; 
    $width_5 = $addorupdate !== 'add' ? 10 : 5;
    $width_3 = $addorupdate !== 'add' ? 8 : 3;
    foreach($array_of_product as $array) {
        $line .= "
                <tr class='line_to_take'>
                    <th class='id'>".$array['idProduit']."</th>
                    <td class='nom'>".$array['nom']."</td>
                    <td class='quantiteStock'>".$array['quantiteStock']."</td>
                    <td class='unite_de_mesure'>".$array['unite_mesure']."</td>
                </tr>
        ";
    }
    $content = "
    $flash
<h2 class='text-secondary m-2 text-center'>Faite une $type dans le depot</h2>
    <form method='post' action='$urlpost' class='container-fluid'>
        <div class='row mb-3'>
            <div class='col-md-$width'></div>
            <div class='col-md-$width'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>N facture </span>
                    <input type='text' class='form-control' value='$value_Nfacture' readonly placeholder='number of facture here : generete its self' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Date</span>
                    <input required type='date' name='date' value='$date' class='form-control' placeholder='facture' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <small class='text-danger'></small>
                
            </div>
        </div>
        <div class='col-md-$width'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Note</span>
                <textarea name='note'  class='form-control' placeholder='Ecrivez une petite note sur la transaction du depot ici ...' aria-label='With textarea'>$value_note</textarea>
            </div>
            <small class='text-danger'></small>
        </div>
        <div class='row'>
            <div class='col-md-$width_5'>
                <div class='input-group mb-3'>
                    <span class='input-group-text' id='basic-addon1'>Produit</span>
                    <input type='hidden' id='contenu_produit'>
                    <input type='text' name='produit' id='myInput'  class='form-control' placeholder='choisissez ici le produit' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div>
                <table class='table table-bordered' id='all-table-product' >
                    <thead>
                        <tr>
                        <th scope='col'>id</th>
                        <th scope='col'>nom du produit</th>
                        <th scope='col'>quantite en stock</th>
                        <th scope='col'>unite de mesure</th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        $line
                    </tbody>

                </table>
                </div>
            </div>
                
            <div class='col-md-$width_3'>
                <div class='input-group mb-3'>
                    <span class='input-group-text'>Quantite</span>
                    <input type='float' id='quantite'  name='quantite' step='0.001' placeholder='Ecrivez la quantite $type  dans le depot ici' class='form-control' aria-label='Amount (to the nearest dollar)'>
                    <span class='input-group-text' id='unite_de_mesure'></span>
                </div>
                <small class='text-danger' id='info-quantity'></small>
            </div>
             <a id='button' class='btn btn-success col-md-2 m-3' href='#'> Ajouter dans la liste</a>
            <input type='hidden' id='array_of_product_and_quantity' name='array_of_product_and_quantity' value='$array_of_product_and_quantity'>
        </div>
        <table class='table table-bordered' id='generale-table' >
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>nom du produit</th>
                <th scope='col'>quantite $type</th>
                <th scope='col'>actions</th>
                </tr>
            </thead>
            <tbody id='tbody'>
                $line_quantity
            </tbody>

        </table>
        <input type='hidden' id='array_of_product' name='array_of_product' value='$array_of_product_in_json' >
        <input type='hidden' name='type' value='".$_GET['q']."'>
        <input type='hidden' name='addorupdate' value='$addorupdate' id='addorupdate'>
        <input type='hidden' name='id' value='$id'>
        <button type='submit' class='btn btn-primary'> Soumettre une $type </button>
    </form>";
    
    return $content;
}

function filter_validate_sortieentreedepot( $url = 'sortieentreedepot.php?q=')
{
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['type'] = $type;
    $url = $url . $type;
    if($type === false) {
        $errors['type'] = 'Mauvais type';
        redirect_with_message('Mauvais type !', FLASH_ERROR, 'sortieentreedepot', $url);
    }

    $array_of_product_and_quantity = filter_input(INPUT_POST, 'array_of_product_and_quantity');
    if($array_of_product_and_quantity  === false) {
        $errors['array_of_product_and_quantity '] = 'Mauvais type';
        redirect_with_message('Vous devriez avoir des produits et les quantites, impossible de process des formulaires vides !', FLASH_ERROR, 'sortieentreedepot', $url);
    }
    $array_of_product_and_quantity = json_decode($array_of_product_and_quantity, true);
    

    $idProduit = filter_input(INPUT_POST, 'idProduit', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input['idProduit'] = $idProduit;
    if ($idProduit !== false && $idProduit !== null) {
        $idProduit = filter_var($idProduit, FILTER_VALIDATE_FLOAT, ['options' => ['min_range'=> 0]]);
    }

    if($idProduit === false) {
        $errors['idProduit'] = 'Le produit doit etre present';
        redirect_with_message('Le produit doit etre present et different de 0', FLASH_ERROR, 'sortieentreedepot', $url);
    }

    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['note'] = $note;

    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
    $input['date'] = $date;

    if($date === false) {
        $errors['date'] = 'La date doit etre presente';
        redirect_with_message('La date doit etre presente', FLASH_ERROR, 'sortieentreedepot', $url);
    }
    $Nfacture = $array_of_product_and_quantity[0]['Nfacture'];
    if (! empty($Nfacture)) {

    } else {
        $Nfacture = new DateTime();
        $Nfacture = $Nfacture->format('Y-m-d H:i:s');
        $pattern = '/\d/';
        if(preg_match_all($pattern, $Nfacture, $matches)) {
            $Nfacture = implode($matches[0]);
        }
    }
    $produit_et_quantite = [];
    
    foreach($array_of_product_and_quantity as $arr) {
        if((int)$arr['idProduit'] && (float)$arr['quantite']) {
            $produit_et_quantite[] = ['idProduit' => $arr['idProduit'], 'note' => $note, 'quantite' => $arr['quantite'], 'date' => $date, 'Nfacture' => $Nfacture, 'type' => $type];
        } else {
            redirect_with_message('Erreur : Un des produit contient des erreurs trouvez lors de l essaie de l enregistrement', FLASH_ERROR, 'sortieentreedepot', $url);
        }
    }
    return $produit_et_quantite;

}