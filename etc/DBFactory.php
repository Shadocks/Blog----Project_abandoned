<?php

namespace Core;

class DBFactory
{
	private $dataConnexion;

	public function __construct()
	{
		$this->loadDataConnexion();
		$this->getConnexion();
	}

	public function loadDataConnexion()
	{
		$this->dataConnexion = require __DIR__. './../app/conf/dataConnexion.php';
	}

	public function getConnexion()
	{
		try {
			return new \PDO('mysql:host=' . $this->dataConnexion['machine'] . '; dbname=' . $this->dataConnexion['db'] . ';charset=utf8', $this->dataConnexion['user'], $this->dataConnexion['password'], array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e) {
			die('<p><strong>Erreur : </strong>' .$e->getMessage(). '</p>');
		}
	}
}

