<?php
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/Comptabilite.php';

  class TypeTrie {
    
    public $typetrie;

    function __construct()
    {
      $this->typetrie = 'typetrie';
    }

    public function insert ($name, $table_de)
    {
      global $pdo;
	  $sql = 'INSERT INTO type_trie(`name`, table_de) VALUES(?, ?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$name, $table_de
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($name, $table_de, $idTypeTrie)
    {
		global $pdo;
		$typetrie = [
			$name, $table_de, $idTypeTrie
		];
		
		$sql = 'UPDATE type_trie
				SET `name` = ?, table_de = ?
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
        $comptabilite = new Comptabilite();
        $compte = $comptabilite->read_by_type_trie($idTypeTrie)[0];
		if (! empty($compte)) {
            return false;
        }
		$sql = 'DELETE FROM type_trie
        WHERE idTypeTrie = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idTypeTrie])) {
			return true;
		}
        return false;
    }

    public function read($table_de = null)
    {
		global $pdo;
		if(empty($table_de)) {
            $sql = 'SELECT * FROM type_trie order by `name` asc';
            $statement = $pdo->query($sql);
        } elseif($table_de == 'sortie' || $table_de == 'entrée') {
            $sql = 'SELECT * FROM type_trie WHERE table_de = ? order by `name` asc';
            $statement = $pdo->prepare($sql);
            $statement->execute([$table_de]);
        }

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }