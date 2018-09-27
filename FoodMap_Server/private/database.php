<?php 
/**
 * 
 */
class Database
{
	private $username = '';
	private $password = '';
	private $host = '';
	private $databaseName = '';

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
			echo 'Connection failed: ' + $e->getMessage();
			return false;
		}
		return true;
	}


	// execute query
	public function query($queryStr)
	{
		$str = explode(" ", $queryStr)[0];
		try
		{
			if (strtolower($str) == 'select')
			{
				$stmt = $this->connection->prepare($queryStr);
				if ($stmt->execute())
				{
					return $stmt->fetchAll();
				}
				else
					return false;
			}
			else
			{
				$this->connection->exec($queryStr);
				return true;
			}
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' + $e->getMessage();
			return false;
		}
	}
}

?>