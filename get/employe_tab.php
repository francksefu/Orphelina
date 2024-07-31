<?php flash('employe'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center">Employés</h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> </small></div>
    </div>
    <?php echo employe_tab($default_array) ?>
<!-- Button trigger modal -->


<?php
   
?>
</main>