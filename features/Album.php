<?php
  require_once __DIR__ . '/connect.php';

  class Album {
    
    public $album;

    function __construct()
    {
      $this->album = 'album';
    }

    public function insert ($filename, $path, $description, $idEnfant, $size, $type, $title)
    {
      global $pdo;
	  $sql = 'INSERT INTO album(`filename`, `path`, `description`, idEnfant, `size`, `type`, title) VALUES(?,?,?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$filename, $path, $description, $idEnfant, $size, $type, $title
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($filename, $path, $description, $idEnfant, $size, $type, $title, $idAlbum)
    {
		global $pdo;
		$album = [
			$filename, $path, $description, $idEnfant, $size, $type, $title, $idAlbum
		];
		
		$sql = 'UPDATE album
				SET `filename` = ?, `path` = ?, `description` = ?, idEnfant = ?, `size` = ?, `type` = ?, title = ?
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
		if ($statement->execute([$idAlbum])) {
			return true;
		}
        return false;
    }

    public function read($idEnfant = null, $type = null)
    {
		global $pdo;
        if(empty((int) $idEnfant)) {
            $sql = 'SELECT * FROM album order by idAlbum desc';
            $statement = $pdo->query($sql);
        } else {
            $sql = 'SELECT * FROM album WHERE idEnfant = ? and `type` = ? order by idAlbum desc';
            $statement = $pdo->prepare($sql);
            $statement->execute([$idEnfant, $type]);
        }

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

  }