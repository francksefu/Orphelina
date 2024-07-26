<?php
require_once __DIR__ . '/connect.php';

  class TypeTrie {
    
    public $typeproduit;

    function __construct()
    {
      $this->typeproduit = 'typeproduit';
    }

    public function insert ($name)
    {
      global $pdo;
	  $sql = 'INSERT INTO type_prduit(`name`) VALUES(?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$name
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($name, $idTypeProduit)
    {
		global $pdo;
		$typeproduit = [
			$name, $idTypeProduit
		];
		
		$sql = 'UPDATE type_produit
				SET `name` = ?
				WHERE idTypeProduit = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($typeproduit)) {
			return true;
		}
        return false;
    }

    public function delete ($idTypeProduit)
    {
		global $pdo;
		
		$sql = 'DELETE FROM type_produit
        WHERE idTypeTrie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idTypeProduit)) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM type_trie LIMIT 800 order by idTypeProduit desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }