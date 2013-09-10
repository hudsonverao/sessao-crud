<?php

class Database
{
	private static $instance = FALSE;

	private function __construct (){
		
		$this->populate();
	}

	private $connection = FALSE;

	public static function singleton ()
	{
		if (self::$instance !== FALSE)
			return self::$instance->getConnection();
		
		$class = __CLASS__;
		
		self::$instance = new $class ();
		
		return self::$instance->getConnection();
	}

	public function getConnection ()
	{
		if ($this->connection)
			return $this->connection;

		return $this->connection = new PDO ('sqlite:sys.sqlite');
	}

	public function populate ()
	{
		$this->getConnection()->exec("CREATE TABLE IF NOT EXISTS User (id INTEGER PRIMARY KEY, login TEXT, pass TEXT, age INTEGER, name TEXT)");    

    	$this->getConnection()->exec("INSERT INTO User (login, pass, age, name) VALUES ('admin', '".md5('123'). "', '25', 'Administrador')");
	}
}