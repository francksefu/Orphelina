<?php
require_once __DIR__ . '/connect.php';

  class Employe {
    
    public $employe;

    function __construct()
    {
      $this->employe = 'employe';
    }

    public function insert ($noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreService, $dateFinService)
    {
      global $pdo;
	  $sql = 'INSERT INTO employes(noms_postnoms, fonction, phone, adressemail, dateNaissance, dateEntreEnService, dateFinService) VALUES(?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreService, $dateFinService
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreService, $dateFinService, $idEmployes)
    {
		global $pdo;
		$employe = [
			$noms_postnoms, $fonction, $phone, $adressemail, $dateNaissance, $dateEntreService, $dateFinService, $idEmployes
		];
		
		$sql = 'UPDATE employes
				SET noms_postnoms = ?, fonction = ?, phone = ?, adressemail = ?, dateNaissance = ?, dateEntreEnService = ?, dateFinService = ?
				WHERE idEmployes = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($employe)) {
			return true;
		}
        return false;
    }

    public function delete ($idEmployes)
    {
		global $pdo;
		
		$sql = 'DELETE FROM employes
        WHERE idEmployes = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idEmployes])) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM employes ORDER BY noms_postnoms DESC LIMIT 800';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	/*public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM employes WHERE `Date` = ? order by idEmployes desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM employes WHERE `Date` between ? and ? order by idEmployes desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}*/
  }