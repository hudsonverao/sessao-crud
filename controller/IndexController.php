<?php

require 'model/Database.php';
require 'model/UserDAO.php';

class IndexController
{
	public function __construct ()
	{
		
	}

	public function  startup ()
	{
		$action = isset ($_GET['action']) ? $_GET['action'] : 'login';

		switch ($action) {
			case 'index':
				$this->indexAction ();
				break;
			case 'login':
				$this->loginAction ();
				break;
			case 'logout':
				$this->logoutAction ();
				break;
			case 'home':
				$this->homeAction ();
				break;
			case 'auth':
				$this->authAction ();
				break;
			case 'insertUser':
				$this->insertUserAction ();
				break;				
			default:
				throw new Exception("Undefined Controller...", 1);				
				break;
		}
	}

	public function authAction ()
	{
		$userDAO = new UserDAO ();

		if($userDAO->authenticate($_POST['login'], $_POST['pass']))
		{
			include"controller/valida_sessao.php";
			header('location: index.php?action=home');
			die();
		}

		header('location: index.php?action=login&error=login_incorret');
	}

	public function loginAction ()
	{
		require 'view/login.php';
	}

	public function logoutAction ()
	{
		require 'view/logout.php';
	}
	
	public function insertUserAction ()
	{
		require 'view/login.php';
	}

	public function homeAction ()
	{
		$userDAO = new UserDAO ();

		$users = $userDAO->findAll ();
		 
		require 'view/home.php';
	}

	public function indexAction ()
	{
		require 'view/index.php';
	}
}