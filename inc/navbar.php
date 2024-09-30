<?php ob_start(); 
if (isset($_SESSION['username'])) { 
  require __DIR__.'/number_of_child.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Nuru ya Uzima</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='magazinien ou depot') { ?>
        <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo tr('Comptabilite') ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') { ?>
            <li><a class="dropdown-item" href="comptabilite.php?q=entrée"><?php echo tr('Ajouter') ?> <?php echo tr('Entrée') ?></a></li>
            <li><a class="dropdown-item" href="comptabilite.php?q=sortie"><?php echo tr('Ajouter') ?> <?php echo tr('Sortie') ?></a></li>
            <li><hr class="dropdown-divider"></li>
            <?php }?>
            <li><a class="dropdown-item" href="comptabilite_tab.php?q=entrée"><?php echo tr('Voir') ?> <?php echo tr('Entrée') ?></a></li>
            <li><a class="dropdown-item" href="comptabilite_tab.php?q=sortie"><?php echo tr('Voir') ?> <?php echo tr('Sortie') ?></a></li>
          </ul>
        </li>

        <?php } }
         if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') { 
         if(isset($_SESSION['post']) && $_SESSION['post'] !=='comptable') { 
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo tr('Produit') ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="produit.php"><?php echo tr('Ajouter') .' '. tr('un') .' '. tr('Produit') ?></a></li>
          <?php } ?>
            <li><a class="dropdown-item" href="produit_tab.php"><?php echo tr('Voir') .' '. tr('les') .' '. tr('Produit') ?></a></li>
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sortieentreedepot.php?q=entrée"><?php echo tr('Ajouter') .' '. tr('une') .' '. tr('entrée dans le depot') ?></a></li>
            <li><a class="dropdown-item" href="sortieentreedepot.php?q=sortie"><?php echo tr('Ajouter') .' '. tr('une') .' '. tr('sortie dans le depot') ?></a></li>
            <?php } ?>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sortieentreedepot_tab.php?q=entrée"><?php echo tr('Voir') .' '. tr('les') .' '. tr('entrée dans le depot') ?></a></li>
            <li><a class="dropdown-item" href="sortieentreedepot_tab.php?q=sortie"><?php echo tr('Voir') .' '. tr('les') .' '. tr('entrée dans le depot') ?></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="inventaire.php?q=entrée"><?php echo tr('Voir')  .' '. tr('l inventaire des entrées dans le depot') ?></a></li>
            <li><a class="dropdown-item" href="inventaire.php?q=sortie"><?php echo tr('Voir') .' '. tr('l inventaire des sorties dans le depot') ?></a></li>
          
          </ul>
        </li>
        <?php } }
        
        if(isset($_SESSION['post']) && $_SESSION['post'] !=='comptable' && $_SESSION['post'] !=='magazinien ou depot') {
        if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') {
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Employes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="employe.php">Ajouter un employé</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="employe_tab.php">Voir les employés</a></li>
            
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo tr('Enfant') ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php 
          if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') {
          if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="child.php"><?php echo tr('Ajouter')  .' '. tr('un').' '.tr('Enfant') ?></a></li>
            <?php } } ?>
            <li><a class="dropdown-item" href="child_tab.php"><?php echo tr('Voir')  .' '. tr('les').' '.tr('enfants') ?></a></li>
            
          </ul>
        </li>
        <?php } ?>
        <?php 
        if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') {
        if(isset($_SESSION['post']) && $_SESSION['post'] !=='magazinien ou depot') {  ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo tr('Parametres') ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="type_trie.php">Ajouter un type de trie pour la comptabilité</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="type_trie_tab.php">Voir les types de trie pour la comptabilité</a></li>
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] =='administrateur') {  ?>
            <li><hr class="dropdown-divider"></li>
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="user.php">Ajouter un utilisateurs</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="user_tab.php">Voir les utilisateurs</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } }?>
        <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='visiteur') {?>
        <li class="nav-item">
          <a class="nav-link" href="rapport.php" tabindex="-1" ><?php echo tr('Rapports') ?></a>
        </li>
        <?php } ?>
        <?php if (isset($_SESSION['username'])) {  ?>
        <li class="nav-item">
          <a class="nav-link btin btn-primary" href="logout.php" tabindex="-1" >Deconnexion <?php echo $_SESSION['username']  ?></a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" >Enfant : <?php echo $total_child  ?></a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<?php } ?>