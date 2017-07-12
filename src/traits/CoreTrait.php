<?php

namespace  Lib\traits;

use Core\DBFactory;

/**
* Classe CoreTrait
*/ 

trait CoreTrait
{
	/** 
	* @var array
	*/
	private $data;

	Public function __construct()
	{
		$this->getData();
	}

	public function getData()
	{
		$this->data = require __DIR__ . './../../app/conf/confPath.php';
	}

	public function getDB()
	{
		return new DBFactory();
	}

	public function getTwig()
	{
		$loader = new \Twig_Loader_Filesystem([$this->data['views_folder']]);
		return new \Twig_Environment($loader);
	}
}