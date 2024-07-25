<?php
  require_once 'connect.php';

  class TypeTrie {
    
    public $typetrie;

    function __construct()
    {
      $this->typetrie = 'typetrie';
    }

    public function insert ($name)
    {
      global $pdo;
	  $sql = 'INSERT INTO type_trie(`name`) VALUES(?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$name
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($name, $idTypeTrie)
    {
		global $pdo;
		$typetrie = [
			$name, $idTypeTrie
		];
		
		$sql = 'UPDATE type_trie
				SET `name` = ?
				WHERE idTypeTrie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($typetrie)) {
			return true;
		}
        return false;
    }

    public function delete ($idTypeTrie)
    {
		global $pdo;
		
		$sql = 'DELETE FROM type_trie
        WHERE idTypeTrie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idTypeTrie)) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM type_trie LIMIT 800 order by idTypeTrie desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }