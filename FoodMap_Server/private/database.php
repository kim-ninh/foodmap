<?php 

class Database
{
	private $username = 'id7274214_phuocpr1998';
	private $password = 'neutachiatay';
	private $host = 'localhost';
	private $databaseName = 'id7274214_foodmap';

	private $connection = null;

	public function connect()
	{
		try
		{
			$this->connection = new PDO("mysql:dbname=$this->databaseName;host=$this->host;charset=UTF8", $this->username, $this->password);
			// set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			return -1;
		}
		return true;
	}


	// execute query
	public function query($queryStr)
	{
		$str = explode(" ", $queryStr)[0];
		try
		{
			if (strtolower($str) == 'select' || strtolower($str) == 'call')
			{
				$stmt = $this->connection->prepare($queryStr);
				if ($stmt->execute())
				{
					$data = $stmt->fetchAll();
					$stmt->closeCursor();
					return $data;
				}
				else
					return -1;
			}
			else
			{
				$this->connection->exec($queryStr);
				return true;
			}
		}
		catch (PDOException $e)
		{
			return -1;
		}
	}

	// close connection
	public function disconnect()
	{
		$this->connection = null;
	}

}

?>