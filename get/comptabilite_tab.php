<?php flash('comptabilite'); ?>
<main class="container-fluid">
    <h2 class="text-secondary m-2 text-center"><?php echo $_GET['q'] ?></h2>
    <div class="row">
        <div class="col-md-7"></div>
        <div class="col-md-4"><small>total : <?php echo $total ?> USD</small></div>
    </div>
    <?php echo comptabilite_tab($default_array); ?>
<!-- Button trigger modal -->

</main>

<?php

