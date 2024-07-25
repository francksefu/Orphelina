<?php
  require_once 'connect.php';

  class Inventaire {
    
    public $inventaire;

    function __construct()
    {
      $this->inventaire = 'inventaire';
    }

    public function insert_one ($idProduit, $quantiteActuelle, $date)
    {
      global $pdo;
      $produit = new Produit();
      $oldQuantity = $produit->read($idProduit)[0]['quantiteStock'];
	  $sql = 'INSERT INTO inventaire(idProduit, quantiteActuelle, difference, `date`) VALUES(?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$idProduit, $quantiteActuelle, $oldQuantity - $quantiteActuelle, $date
	  ]);

	  return $pdo->lastInsertId();
    }

    public function insert_many($array_inventaire)
    {
        foreach($array_inventaire as $inventaire) {
            $this->insert_one($inventaire['idProduit'], $inventaire['quantiteActuelle'], $inventaire['difference'], $inventaire['date'], $inventaire['Nfacture']);
        }
    }

    public function update ($idProduit, $quantiteActuelle, $difference, $date, $idInventaire)
    {
		global $pdo;
		$inventaire = [
			$idProduit, $quantiteActuelle, $difference, $date, $idInventaire
		];
		
		$sql = 'UPDATE inventaire
				SET idProduit = ?, quantiteActuelle = ?, difference = ?, `date` = ?
				WHERE idInventaire = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($inventaire)) {
			return true;
		}
        return false;
    }

    public function delete ($idInventaire)
    {
		global $pdo;
		
		$sql = 'DELETE FROM inventaire
        WHERE idInventaire = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idInventaire])) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM inventaire LIMIT 800 order by idInventaire desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM inventaire WHERE `Date` = ? order by idInventaire desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM inventaire WHERE `Date` between ? and ? order by idInventaire desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}
  }