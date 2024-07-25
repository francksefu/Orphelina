<?php
  require_once 'connect.php';
  require_once 'Reunification.php';

  class Enfant {
    
    public $enfant;

    function __construct()
    {
      $this->enfant = 'enfant';
    }

    public function insert ($noms_postnoms, $sexe, $dateArrivee, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee)
    {
      global $pdo;
      $reunification = new Reunification();
      $idReunification = $reunification->insert('non reunifié', null);
	  $sql = 'INSERT INTO enfant(noms_postnoms, sexe, dateArrivee, parents, provenance, objetDeReferencement, observation_a_l_arrivee, idReunification) VALUES(?,?,?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$noms_postnoms, $sexe, $dateArrivee, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee, $idReunification
	  ]);
	  
	  return $pdo->lastInsertId();
    }

    public function update ($noms_postnoms, $sexe, $dateArrivee, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee, $idEnfant)
    {
		global $pdo;
		$enfant = [
			$noms_postnoms, $sexe, $dateArrivee, $parents, $provenance, $objetDeReferencement, $observation_a_l_arrivee
		];
		
		$sql = 'UPDATE enfant
				SET noms_postnoms = ?, sexe = ?, dateArrivee = ?, parents = ?, provenance = ?, objetDeReferencement = ?, observation_a_l_arrivee = ?
				WHERE idEnfant = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($enfant)) {
			echo 'The publisher has been updated successfully!';
		}
    }

    public function delete ($idEnfant)
    {
		global $pdo;
		
		$sql = 'DELETE FROM enfant
        WHERE idEnfant = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idEnfant)) {
			echo 'The publisher has been successfully!';
		}
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM enfant LIMIT 800 order by idEnfant desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search_by_name()
    {

    }

  }