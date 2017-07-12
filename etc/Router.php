<?php

namespace Core;

use Lib\controller\Controller;

class Router
{
	public function routes()
	{
		switch ($_SERVER['REQUEST_URI']) {
			case $_SERVER['REQUEST_URI'] === '/':
				$controller = new Controller();
				return $controller->indexAction();
				break;
			case $_SERVER['REQUEST_URI'] === '/articles':
				$controller = new Controller();
				return $controller->articlesAction();
				break;
			case $_SERVER['REQUEST_URI'] === '/article/detail':
				$controller = new Controller();
				return $controller->articleDetailAction();
				break;
		}
	}
}



