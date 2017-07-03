<?php

namespace Lib\controller;

use Lib\controller\core\ControllerTrait;

class Controller extends ControllerTrait
{
	public function indexAction()
	{
		echo $this->getTwig()->render('index.html.twig');
	}

	public function articlesAction()
	{
		echo $this->getTwig()->render('articles.html.twig');
	}

	public function articleDetailAction()
	{
		echo $this->getTwig()->render('articleDetail.html.twig');
	}
}