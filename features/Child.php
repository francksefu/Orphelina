<?php
require_once __DIR__ . '/connect.php';

  class Enfant {
    
    public $enfant;

    function __construct()
    {
      $this->enfant = 'enfant';
    }

    public function insert ($nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification)
    {
      global $pdo;
	  $sql = 'INSERT INTO children(nom, sexe, dateNaissance, ecoleClassCourant, dateArrivee, ageEntree, freres_et_soeurs, histoire, sujet_favoris, travail_de_reve, nourriture_favoris, hobbies, couleur, meilleur_ami, talent, grand_reves, traits_interessant, status_de_reunification, description_sur_la_reunification, date_de_reunification) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?, ?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification, $idEnfant)
    {
		global $pdo;
		$enfant = [
			$nom, $sexe, $dateNaissance, $ecoleClassCourant, $dateArrivee, $ageEntree, $freres_et_soeurs, $histoire, $sujet_favoris, $travail_de_reve, $nourriture_favoris, $hobbies, $couleur, $meilleur_ami, $talent, $grand_reves, $traits_interessant, $status_de_reunification, $description_sur_la_reunification, $date_de_reunification, $idEnfant
		];
		
		$sql = 'UPDATE children
				SET nom = ?, sexe = ?, dateNaissance = ?, ecoleClassCourant = ?, dateArrivee = ?, ageEntree = ?, freres_et_soeurs = ?, histoire = ?, sujet_favoris = ?, travail_de_reve = ?, nourriture_favoris = ?, hobbies = ?, couleur = ?, meilleur_ami = ?, talent = ?, grand_reves = ?, traits_interessant = ?, status_de_reunification = ?, description_sur_la_reunification = ?, date_de_reunification = ?
				WHERE idEnfant = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($enfant)) {
			return true;
		}
        return false;
    }

    public function delete ($idEnfant)
    {
		global $pdo;
		
		$sql = 'DELETE FROM children
        WHERE idEnfant = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idEnfant])) {
			return true;
		}
        return false;
    }

    public function read($idEnfant = null)
    {
		global $pdo;
        if(empty((int) $idEnfant)) {
            $sql = 'SELECT * FROM children order by nom asc';
            $statement = $pdo->query($sql);
        } else {
            $sql = 'SELECT * FROM children WHERE idEnfant = ? order by nom asc';
            $statement = $pdo->prepare($sql);
            $statement->execute([$idEnfant]);
        }

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function read_by_date($date1, $date2)
    {
		global $pdo;
        $sql = 'SELECT * FROM children WHERE date_de_reunification between  ? and ? order by nom asc';
        $statement = $pdo->prepare($sql);
        $statement->execute([$date1, $date2]);

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