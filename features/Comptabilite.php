<?php
  require_once __DIR__.  '/connect.php';

  class Comptabilite {
    
    public $comptabilite;

    function __construct()
    {
      $this->comptabilite = 'comptabilite';
    }

    public function insert ($montant, $motif, $date, $Nfacture, $typeComptabilite, $idTypeTrie)
    {
      global $pdo;
	  $sql = 'INSERT INTO comptabilite(montant, motif, `Date`, Nfacture, typeComptabilite, idTypeTrie) VALUES(?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$montant, $motif, $date, $Nfacture, $typeComptabilite, $idTypeTrie
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($montant, $motif, $date, $Nfacture, $idTypeTrie, $idComptabilite)
    {
		global $pdo;
		$comptabilite = [
			$montant, $motif, $date, $Nfacture, $idTypeTrie, $idComptabilite
		];
		
		$sql = 'UPDATE comptabilite
				SET montant = ?, motif = ?, `date` = ?, Nfacture = ?, idTypeTrie = ?
				WHERE idComptabilite = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($comptabilite)) {
			return true;
		}
		return false;
    }

    public function delete ($idComptabilite)
    {
		global $pdo;
		
		$sql = 'DELETE FROM comptabilite
        WHERE idComptabilite = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idComptabilite])) {
			return true;
		}
		return false;
    }

	public function read_by_type_trie($idTypeTrie)
	{
		global $pdo;
        $sql = 'SELECT * FROM comptabilite WHERE idTypeTrie = ? order by idTypeTrie desc';
            $statement = $pdo->prepare($sql);
            $statement->execute([$idTypeTrie]);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

    public function read($type = null, $date1 = '', $date2 = '', $type_trie = '')
    {
		global $pdo;
		$sql = 'SELECT * FROM comptabilite, type_trie WHERE comptabilite.idTypeTrie = type_trie.idTypeTrie  ORDER BY idComptabilite DESC LIMIT 800';
		if ($type == 'entrée' &&  empty($date1) && empty ($date2) && empty ($type_trie)) {
			$sql = "SELECT * FROM comptabilite, type_trie WHERE typeComptabilite = 'entrée' and (comptabilite.idTypeTrie = type_trie.idTypeTrie) ORDER BY idComptabilite DESC LIMIT 800";
		}
		if ($type == 'sortie' &&  empty($date1) && empty ($date2) && empty ($type_trie)) {
			$sql = "SELECT * FROM comptabilite, type_trie WHERE typeComptabilite = 'sortie' and (comptabilite.idTypeTrie = type_trie.idTypeTrie) ORDER BY idComptabilite DESC LIMIT 800";
		}

		if (! empty($type) && ! empty($date1) && empty ($date2) && empty ($type_trie)) {
			$sql = "SELECT * FROM comptabilite, type_trie WHERE typeComptabilite = ? and (comptabilite.idTypeTrie = type_trie.idTypeTrie) and (`date` = ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$type, $date1]);

			return $stmt->fetchAll();
		}

		if (! empty($type) && ! empty($date1) && ! empty ($date2)&& empty ($type_trie)) {
			$sql = "SELECT * FROM comptabilite, type_trie WHERE typeComptabilite = ? and (comptabilite.idTypeTrie = type_trie.idTypeTrie) and ( `Date` between ? and ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$type, $date1, $date2]);

			return $stmt->fetchAll();
		}

		if (! empty($type) && ! empty($date1) && empty ($date2)&& ! empty ($type_trie)) {
			$sql = "SELECT * FROM comptabilite, type_trie WHERE typeComptabilite = ? and (comptabilite.idTypeTrie = type_trie.idTypeTrie) and ( `date` = ? and comptabilite.idTypeTrie = ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$type, $date1, $type_trie]);

			return $stmt->fetchAll();
		}

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function find_one($idComptabilite)
	{
		global $pdo;
		$sql = 'SELECT * FROM comptabilite WHERE idComptabilite = ?';
		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$idComptabilite]);

		// Fetch all results
		return $stmt->fetchAll();
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