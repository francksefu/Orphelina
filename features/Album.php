<?php
  require_once 'connect.php';

  class Album {
    
    public $album;

    function __construct()
    {
      $this->album = 'album';
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

    public function update ($filename, $path, $description, $idEnfant, $size, $idAlbum)
    {
		global $pdo;
		$album = [
			$filename, $path, $description, $idEnfant, $size, $idAlbum
		];
		
		$sql = 'UPDATE album
				SET `filename` = ?, `path` = ?, `description` = ?, idEnfant = ?, `size` = ?
				WHERE idAlbum = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($album)) {
			return true;
		}
        return false;
    }

    public function delete ($idAlbum)
    {
		global $pdo;
		
		$sql = 'DELETE FROM album
        WHERE idAlbum = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute($idAlbum)) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM album LIMIT 800 order by idAlbum desc';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }