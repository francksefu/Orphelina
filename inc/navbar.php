<?php ob_start(); 
if (isset($_SESSION['username'])) { 
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">Open Springs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='magazinien ou depot') { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Comptabilite
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') { ?>
            <li><a class="dropdown-item" href="comptabilite.php?q=entrée">Ajouter une Entree</a></li>
            <li><a class="dropdown-item" href="comptabilite.php?q=sortie">Ajouter une Sortie</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php }?>
            <li><a class="dropdown-item" href="comptabilite_tab.php?q=entrée">Voir les entrees</a></li>
            <li><a class="dropdown-item" href="comptabilite_tab.php?q=sortie">Voir les sorties</a></li>
          </ul>
        </li>

        <?php } 
         if(isset($_SESSION['post']) && $_SESSION['post'] !=='comptable') { 
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Produit
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="produit.php">Ajouter un produit</a></li>
          <?php } ?>
            <li><a class="dropdown-item" href="produit_tab.php">Voir les produits</a></li>
            <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sortieentreedepot.php?q=entrée">Ajouter une entrée dans le depot</a></li>
            <li><a class="dropdown-item" href="sortieentreedepot.php?q=sortie">Ajouter une sortie dans le depot</a></li>
            <?php } ?>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sortieentreedepot_tab.php?q=entrée">Voir les entrées dans le depot</a></li>
            <li><a class="dropdown-item" href="sortieentreedepot_tab.php?q=sortie">Voir les sorties dans le depot</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="inventaire.php?q=entrée">Voir l inventaire des entrées dans le depot</a></li>
            <li><a class="dropdown-item" href="inventaire.php?q=sortie">Voir l inventaire des sorties dans le depot</a></li>
          
          </ul>
        </li>
        <?php } 
        if(isset($_SESSION['post']) && $_SESSION['post'] !=='comptable' && $_SESSION['post'] !=='magazinien ou depot') { 
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
            Enfant
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='directeur') {?>
            <li><a class="dropdown-item" href="enfant.php">Ajouter un enfant</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="enfant_tab.php">Voir les enfant</a></li>
            
          </ul>
        </li>
        <?php if(isset($_SESSION['post']) && $_SESSION['post'] !=='magazinien ou depot') {  ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Parametres
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
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="rapport.php" tabindex="-1" >Rapports</a>
        </li>
        <?php if (isset($_SESSION['username'])) {  ?>
        <li class="nav-item">
          <a class="nav-link btin btn-primary" href="logout.php" tabindex="-1" >Deconnexion <?php echo $_SESSION['username']  ?></a>
        </li>
        <?php } ?>
      </ul>
      
    </div>
  </div>
</nav>
<?php } ?>