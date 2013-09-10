<?php

require 'model/User.php';

class UserDAO
{
	private $connection;

	public function __construct ()
	{
		$this->connection = Database::singleton ();
	}

	public function authenticate ($login, $pass)
	{
		$pass = md5($pass);

		$sth = $this->connection->prepare ("SELECT pass FROM User where login like '". $login. "'");

		$sth->execute ();

		$user  = $sth->fetchObject ();

		if(!$user)
			return NULL;

		return $user->pass == $pass;
	}

	public function findAll ()
	{

		$sth = $this->connection->prepare ('SELECT * FROM User');
		$sth->execute();

		$users = array ();

		while ($obj =  $sth->fetchObject())
		{
			$user = new User ();

			$user->setId ($obj->id);
			$user->setLogin($obj->login);
			$user->setName ($obj->name);
			$user->setAge ($obj->age);
			$user->setPass ($obj->pass);

			$users [] = $user;
		}

		return $users;
	}
}