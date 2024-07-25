<?php
  require_once 'connect.php';

  class Produit {
    
    public $produit;

    function __construct()
    {
      $this->produit = 'produit';
    }

    public function insert ($nom, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit)
    {
      global $pdo;
	  $sql = 'INSERT INTO produit(nom, `description`, quantiteSotck, prixUnitaire, idTypeProduit) VALUES(?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$nom, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($nom, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $idProduit)
    {
		global $pdo;
		$produit = [
			$nom, $description, $quantiteSotck, $prixUnitaire, $idTypeProduit, $idProduit
		];
		
		$sql = 'UPDATE produit
				SET nom = ?, `description` = ?, quantiteSotck = ?, prixUnitaire = ?, idTypeProduit = ?
				WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($produit)) {
			echo 'The publisher has been updated successfully!';
		}
    }

    public function delete ($idProduit)
    {
		global $pdo;
		
		$sql = 'DELETE FROM produit
        WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idProduit)) {
			echo 'The publisher has been successfully!';
		}
    }

    public function read($idProduit = null)
    {
		global $pdo;
        if(! empty((int) $idProduit)) {
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
				SET quantiteSotck = ?
				WHERE idProduit = ?';
		
		$statement = $pdo->prepare($sql);
        if ($type = 'delete') {
            $newQuantity = $ancienneQuantiteStock - $quantiteEntree;
        } elseif($type = 'add') {
            $newQuantity = $ancienneQuantiteStock + $quantiteEntree;
        }

		// execute the UPDATE statment
		if ($statement->execute([$newQuantity, $idProduit])) {
			return true;
		} 
        return false;
    }

  }