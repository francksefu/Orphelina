<?php
require_once __DIR__ . '/connect.php';

  class Produit {
    
    public $produit;

    function __construct()
    {
      $this->produit = 'produit';
    }

    public function insert ($nom, $marque , $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $unite_mesure, $package = null, $nom_package = null)
    {
      global $pdo;
	  $sql = 'INSERT INTO produit(nom, marque, `description`, quantiteStock, prixUnitaire, idTypeProduit, unite_mesure, package, nom_package) VALUES(?,?,?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$nom, $marque, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $unite_mesure, $package, $nom_package
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($nom, $marque, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $unite_mesure, $package, $nom_package, $idProduit)
    {
		global $pdo;
		$produit = [
			$nom, $marque, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $unite_mesure, $package, $nom_package, $idProduit
		];
		
		$sql = 'UPDATE produit
				SET nom = ?, marque = ?, `description` = ?, quantiteStock = ?, prixUnitaire = ?, idTypeProduit = ?, unite_mesure = ?, package = ?, nom_package = ?
				WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($produit)) {
			return true;
		}
        return false;
    }

    public function delete ($idProduit)
    {
		global $pdo;
		
		$sql = 'DELETE FROM produit
        WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idProduit])) {
			return true;
		}
        return false;
    }

    public function read($idProduit = null)
    {
		global $pdo;
        if(empty((int) $idProduit)) {
            $sql = 'SELECT * FROM produit order by nom asc';
            $statement = $pdo->query($sql);
        } else {
            $sql = 'SELECT * FROM produit WHERE idProduit = ? order by nom asc';
            $statement = $pdo->prepare($sql);
            $statement->execute([$idProduit]);
        }

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // cette fonction permet de remettre la quantite ajoute lors de l ajout(entree produit), cas de supression de l entree produit
    public function ajouter_soustraire_entree_depot($idProduit, $quantiteEntree, $type)
    {
        global $pdo;
        $ancienneQuantiteStock = $this->read($idProduit)[0]['quantiteStock'];
        $sql = 'UPDATE produit
				SET quantiteStock = ?
				WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);
        if ($type == 'delete') {
            $newQuantity = $ancienneQuantiteStock - $quantiteEntree;
        } elseif($type =='add') {
            $newQuantity = $ancienneQuantiteStock + $quantiteEntree;
        }

		// execute the UPDATE statment
		if ($statement->execute([$newQuantity, $idProduit])) {
			return true;
		} 
        return false;
    }

  }