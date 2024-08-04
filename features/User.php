<?php
require_once __DIR__ . '/connect.php';

  class User {
    
    public $user;

    function __construct()
    {
      $this->user = 'user';
    }

    public function insert ($username, $password, $post, $etat, $langue)
    {
      global $pdo;
	  $sql = 'INSERT INTO user (username, `password`, post, `state`, langue) VALUES(?,?,?,?,?)';

	  $statement = $pdo->prepare($sql);
	  
	  $statement->execute([
		$username, $password, $post, $etat, $langue
	  ]);

	  return $pdo->lastInsertId();
    }

    public function update ($username, $password, $post, $etat, $idUser)
    {
		global $pdo;
		$user = [
			$username, $password, $post, $etat, $idUser
		];
		
		$sql = 'UPDATE user
				SET username = ?, `password` = ?, post = ?, etat = ?
				WHERE idUser = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the UPDATE statment
		if ($statement->execute($user)) {
			return true;
		}
        return false;
    }

    public function delete ($idUser)
    {
		global $pdo;
		
		$sql = 'DELETE FROM user
        WHERE idUser = ?';
		
		$statement = $pdo->prepare($sql);

		// execute the DELETE statment
		if ($statement->execute([$idUser])) {
			return true;
		}
        return false;
    }

    public function read()
    {
		global $pdo;
		$sql = 'SELECT * FROM user ORDER BY username ASC ';

		$statement = $pdo->query($sql);

		// get all publishers
		return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function find_user_by_username(string $username)
    {
        global $pdo;
        $sql = 'SELECT *
                FROM user
                WHERE username = ?';

        $statement = $pdo->prepare($sql);
        $statement->execute([$username]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

  }