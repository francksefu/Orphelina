<?php
  require_once 'connect.php';

  class Reunification {
    
    public $reunification;

    function __construct()
    {
      $this->reunification = 'reunification';
    }

    public function insert ($status, $description)
    {
      global $pdo;
	  $sql = 'INSERT INTO reunification(`status`, `description`) VALUES(?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$status, $description
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($status, $description, $idReunification)
    {
		global $pdo;
		$reunification = [
			$status, $description, $idReunification
		];
		
		$sql = 'UPDATE reunification
				SET `status` = ?,  `description` = ?
				WHERE idReunification = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($reunification)) {
			echo 'The publisher has been updated successfully!';
		}
    }
  }