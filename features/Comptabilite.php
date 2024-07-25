<?php
  require_once 'connect.php';

  class Comptabilite {
    
    public $comptabilite;

    function __construct()
    {
      $this->comptabilite = 'comptabilite';
    }

    public function insert ($montant, $motif, $date, $heure, $Nfacture, $typeComptabilite, $typeTrie)
    {
      global $pdo;
	  $sql = 'INSERT INTO comptabilite(montant, motif, `Date`, `heure`, Nfacture, typeComptabilite, typeTrie) VALUES(?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$montant, $motif, $date, $heure, $Nfacture, $typeComptabilite, $typeTrie
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($montant, $motif, $date, $heure, $Nfacture, $typeComptabilite, $typeTrie, $idComptabilite)
    {
		global $pdo;
		$comptabilite = [
			$montant, $motif, $date, $heure, $Nfacture, $typeComptabilite, $typeTrie, $idComptabilite
		];
		
		$sql = 'UPDATE comptabilite
				SET montant = ?, motif = ?, `date` = ?, heure = ?, Nfacture = ?, typeComptabilite = ?, typeTrie = ?
				WHERE idComptabilite = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($comptabilite)) {
			echo 'The publisher has been updated successfully!';
		}
    }

    public function delete ($idComptabilite)
    {
		global $pdo;
		
		$sql = 'DELETE FROM comptabilite
        WHERE idComptabilite = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idComptabilite)) {
			echo 'The publisher has been successfully!';
		}
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM comptabilite LIMIT 800 order by idComptabilite desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM comptabilite WHERE `Date` = ? order by idComptabilite desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM comptabilite WHERE `Date` between ? and ? order by idComptabilite desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}
  }