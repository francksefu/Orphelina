<?php
  require_once 'connect.php';

  class Dossier {
    
    public $dossier;

    function __construct()
    {
      $this->dossier = 'dossier';
    }

    public function insert ($filename, $path, $description, $idEnfant, $size)
    {
      global $pdo;
	  $sql = 'INSERT INTO album(`filename`, `path`, `description`, idEnfant, `size`) VALUES(?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$filename, $path, $description, $idEnfant, $size
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($filename, $path, $description, $idEnfant, $size, $idDossier)
    {
		global $pdo;
		$album = [
			$filename, $path, $description, $idEnfant, $size, $idDossier
		];
		
		$sql = 'UPDATE dossier
				SET `filename` = ?, `path` = ?, `description` = ?, idEnfant = ?, `size` = ?
				WHERE idDossier = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($album)) {
			return true;
		}
        return false;
    }

    public function delete ($idDossier)
    {
		global $pdo;
		
		$sql = 'DELETE FROM dossier
        WHERE idDossier = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idDossier)) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM dossier LIMIT 800 order by idDossier desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }