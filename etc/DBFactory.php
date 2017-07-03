<?php

namespace Core;

class DBFactory
{
	private $conf;

	public function __construct()
	{
		$this->loadConf();
		$this->getConnexion();
	}

	public function loadConf()
	{
		$this->conf = require __DIR__. './../app/conf/confDb.php';
	}

	public function getConnexion()
	{
		try {
			$db = new \PDO('mysql:host=' . $this->conf['machine'] . '; dbname=' . $this->conf['db'] . ';charset=utf8', $this->conf['user'], $this->conf['password'], array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e) {
			die('<p><strong>Erreur : </strong>' .$e->getMessage(). '</p>');
		}
		return $db;
	}
}
