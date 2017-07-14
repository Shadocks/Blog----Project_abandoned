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
			case $_SERVER['REQUEST_URI'] === '/formulaire':
				$controller = new controller();
				return $controller->formAction();
				break;
			case $_SERVER['REQUEST_URI'] === '/article/ajouter':
				$controller = new controller();
				return $controller->addArticleAction();
				break;
			case $_SERVER['REQUEST_URI'] === '/article/article/modifier?id=' . $_GET['id']:
				$id = (int) $_GET['id'];
				$controller = new controller();
				return $controller->updateArticleAction($id);
				break;
			case $_SERVER['REQUEST_URI'] === '/article/detail?id=' . $_GET['id']:
				$controller = new Controller();
				return $controller->articleDetailAction();
				break;
		}
	}
}



