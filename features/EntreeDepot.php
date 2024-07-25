<?php
  require_once 'connect.php';
  require_once 'produit.php';

  class EntreeDepot {
    
    public $entreedepot;

    function __construct()
    {
      $this->entreedepot = 'entreedepot';
    }

    public function insert_many($array_entree_depot)
    {
        foreach($array_entree_depot as $entree_depot) {
            $this->insert_one($entree_depot['quantiteAjoute'], $entree_depot['prixUnitaire'], $entree_depot['observation'], $entree_depot['date'], $entree_depot['Nfacture'], $entree_depot['idProduit'], $entree_depot['provenance']);
        }
    }

    public function insert_one ($quantiteAjoute, $prixUnitaire, $observation, $date, $Nfacture, $idProduit, $provenance)
    {
        global $pdo;
        $produit = new Produit();
        if ($produit->ajouter_soustraire_entree_depot($idProduit, $quantiteAjoute, 'add')) {
            $sql = 'INSERT INTO entree_depot(quantiteAjoute, prixUnitaire, observation, `date`, Nfacture, idProduit, provenance) VALUES(?,?,?,?,?,?,?)';
            
            $statement = $pdo->prepare($sql);
            
            $statement->execute([
                $quantiteAjoute, $prixUnitaire, $observation, $date, $Nfacture, $idProduit, $provenance
            ]);
    
            return $pdo->lastInsertId();
        }
        return false;
    }

    public function update ($array_entree_depot, $Nfacture)
    {
		$this->delete($Nfacture);
        $this->insert_many($array_entree_depot);
    }

    public function delete ($Nfacture)
    {
		global $pdo;
        $entree_depot = $this->read_par_Nfacture($Nfacture);
        $produit = new Produit();
        foreach($entree_depot as $entree) {
            $produit->ajouter_soustraire_entree_depot($entree['idProduit'], $entree['quantiteAjoute'], 'delete');
        }
		
		$sql = 'DELETE FROM entree_depot
        WHERE Nfacture = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($Nfacture)) {
			return true;
		}
        return false;
    }

    public function read_par_Nfacture($Nfacture)
    {
        global $pdo;
		$sql = 'SELECT * FROM entree_depot WHERE Nfacture = ? order by idEntre desc';

		$statement = $pdo->prepare($sql);
        $statement->execute([$Nfacture]);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM entree_depot LIMIT 800 order by idEntree desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM entree_depot WHERE `Date` = ? order by idEntree desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM entree_depot WHERE `Date` between ? and ? order by idEntree desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}
  }