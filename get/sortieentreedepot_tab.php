<?php flash('sortieentreedepot');?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center"><?php echo $_GET['q'] ?> depot</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>

<?php
echo sortieentreedepot_tab ($default_array, $array_of_product);

?>

</main>