<?php
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/Produit.php';

  class SortieEntreeDepot {
    
    public $sortieentreedepot;

    function __construct()
    {
      $this->sortieentreedepot = 'sortieentreedepot';
    }

    public function insert ($idProduit, $note, $quantite, $date, $Nfacture, $type)
    {
      global $pdo;
	  $sql = 'INSERT INTO entree_sortie_depot(idProduit, note, quantite, `date`, Nfacture, `type`) VALUES(?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
      if ($statement->execute([$idProduit, $note, $quantite, $date, $Nfacture, $type])) {
        if ($type == 'entrée') {
            $type_s = 'add';
        } elseif($type == 'sortie') {
            $type_s = 'delete';
        }
        $produit = new Produit();
        $produit->ajouter_soustraire_entree_depot($idProduit, $quantite, $type_s);
        return true;
      }
      return false;
    }

    public function insert_multiple($array)
    {
        foreach($array as $arr) {
            if (! ($this->insert($arr['idProduit'], $arr['note'], $arr['quantite'], $arr['date'], $arr['Nfacture'], $arr['type']))) {
                return false;
            }
        }
        return true;
    }

    public function update ($Nfacture, $array)
    {
		global $pdo;
        if($this->delete($Nfacture)) {
            $this->insert_multiple($array);
            return true;
        }
		return false;
    }

    public function delete ($Nfacture)
    {
		global $pdo;
		$to_update_product = $this->read($Nfacture);
        if ($to_update_product[0]) {
            if ($to_update_product[0]['type'] == 'entrée') {
                $type = 'delete';
            } elseif($to_update_product[0]['type'] == 'sortie') {
                $type = 'add';
            }
            $produit = new Produit();
            foreach($to_update_product as $array) {
                $produit->ajouter_soustraire_entree_depot($array['idProduit'], $array['quantite'], $type);
            }
            $sql = 'DELETE FROM entree_sortie_depot
            WHERE Nfacture = ?';
            
            $statement = $pdo->prepare($sql);

            // execute the DELETE statment
            if ($statement->execute([$Nfacture])) {
                return true;
            }
            return false;
        } else {
            return false;
        }
		
    }

    public function read_group_by_facture($type, $date1 = '', $date2 = '')
{
    global $pdo;
    $array_to_return = [];
    if(! empty($type) && empty($date1) && empty($date2)) {
        $sql_1 = 'SELECT Nfacture FROM entree_sortie_depot WHERE `type` = ? GROUP BY Nfacture ORDER BY Nfacture DESC LIMIT 900';
        $statement_1 = $pdo->prepare($sql_1);
        $stmt = $statement_1->execute([$type]);
    } elseif(! empty($type) && ! empty($date1) && empty($date2)) {
        $sql_1 = 'SELECT Nfacture FROM entree_sortie_depot WHERE `type` = ? and `date` = ? GROUP BY Nfacture ORDER BY Nfacture DESC ';
        $statement_1 = $pdo->prepare($sql_1);
        $stmt = $statement_1->execute([$type, $date1]);
    } elseif (! empty($type) && ! empty($date1) && ! empty($date2)) {
        $sql_1 = 'SELECT Nfacture FROM entree_sortie_depot WHERE `type` = ? and `date` between ? and ? GROUP BY Nfacture ORDER BY Nfacture DESC ';
        $statement_1 = $pdo->prepare($sql_1);
        $stmt = $statement_1->execute([$type,$date1, $date2]);
    }
    
    
    
    //$statement_1 = $pdo->prepare($sql_1);
    
    if ($stmt) {
        $data_group_by = $statement_1->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($data_group_by as $data) {
            $data_content = $this->read($data['Nfacture']);
            $array_to_return[] = [
                'note' => $data_content[0]['note'],
                'Date' => $data_content[0]['date'],
                'heure' => $data_content[0]['heure'],
                'Nfacture' => $data['Nfacture'],
                'type' => $data_content[0]['type'],
                'data_content' => $data_content
            ];
        }
        
        return $array_to_return;
    }
    
    return []; // Optionally, return an empty array if the execution fails
}


    public function read($Nfacture = null, $idProduit = null, $type = null, $date1 = null, $date2 = null)
    {
		global $pdo;
		if ($Nfacture) {
			$sql = 'SELECT * FROM entree_sortie_depot WHERE Nfacture = ? ORDER BY idSortieEntree DESC LIMIT 800';
            $statement = $pdo->prepare($sql);
            if ($statement->execute([$Nfacture])) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
		} elseif($idProduit && $type && empty($date1) && empty($date2)) {
            $sql = 'SELECT * FROM entree_sortie_depot WHERE (idProduit = ? and `type` = ?)';
            $statement = $pdo->prepare($sql);
            if ($statement->execute([$idProduit, $type])) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        }elseif($idProduit && $type && $date1 && empty($date2)) {
            $sql = 'SELECT * FROM entree_sortie_depot WHERE (idProduit = ? and `type` = ? and `date` = ?)';
            $statement = $pdo->prepare($sql);
            if ($statement->execute([$idProduit, $type, $date1])) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        }elseif($idProduit && $type && $date1 && ! empty($date2)) {
            $sql = 'SELECT * FROM entree_sortie_depot WHERE (idProduit = ? and `type` = ? and (`date` between ? and ?))';
            $statement = $pdo->prepare($sql);
            if ($statement->execute([$idProduit, $type, $date1, $date2])) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        } else {
            $sql = 'SELECT * FROM entree_sortie_depot ORDER BY idSortieEntree DESC LIMIT 800';
            $statement = $pdo->query($sql);
        }
		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

	public function querySurUneDate($date)
	{
		global $pdo;
		$sql = 'SELECT * FROM entree_sortie_depot WHERE `Date` = ? order by idSortie desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date]);

		// Fetch all results
		return $stmt->fetchAll();
	}

	public function querySurDeuxDate($date1, $date2)
	{
		global $pdo;
		$sql = 'SELECT * FROM entree_sortie_depot WHERE `Date` between ? and ? order by idSortie desc';

		$stmt = $pdo->prepare($sql);

		// Execute the statement
		$stmt->execute([$date1, $date2]);

		// Fetch all results
		return $stmt->fetchAll();
	}

    public function read_inventaire_produit($type, $date1 = null, $date2 = null)
    {
        $array_to_return = [];
        $produit = new Produit();
        $produits = $produit->read();
        foreach($produits as $par_produit) {
            $entree_sortie = $this->read(null, $par_produit['idProduit'], $type, $date1, $date2);
            $quantite_total = array_reduce(
                $entree_sortie,
                function ($prev, $item) {
                    return $prev + $item['quantite'];
                }
            );
            if(empty($quantite_total)) {
                $quantite_total = 0;
            }
            $array_to_return[] = ['nom' => $par_produit['nom'], "quantite_total" => $quantite_total, 'quantiteStock' => $par_produit['quantiteStock'], 'unite_mesure' => $par_produit['unite_mesure']];
        }
		return $array_to_return;
    }
  }