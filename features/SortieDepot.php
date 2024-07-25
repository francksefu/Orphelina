<?php
  require_once 'connect.php';

  class SortieDepot {
    
    public $sortiedepot;

    function __construct()
    {
      $this->sortiedepot = 'sortiedepot';
    }

    public function insert ($idProduit, $description, $date, $Nfacture)
    {
      global $pdo;
	  $sql = 'INSERT INTO sortie_depot(idProduit, `description`, `date`, Nfacture) VALUES(?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$idProduit, $description, $date, $Nfacture
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($idProduit, $description, $date, $Nfacture, $idSortie)
    {
		global $pdo;
		$sortiedepot = [
			$idProduit, $description, $date, $Nfacture, $idProduit
		];
		
		$sql = 'UPDATE sortie_depot
				SET idProduit = ?, `description` = ?, `date` = ?, Nfacture = ?
				WHERE idSortie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($sortiedepot)) {
			return true;
		}
        return false;
    }

    public function delete ($idSortie)
    {
		global $pdo;
		
		$sql = 'DELETE FROM sortie_depot
        WHERE idSortie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idSortie])) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM sortie_depot LIMIT 800 order by idSortie desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM sortie_depot WHERE `Date` = ? order by idSortie desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM sortie_depot WHERE `Date` between ? and ? order by idSortie desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}
  }