<?php

namespace Lib\controller;

use Lib\controller\core\ControllerTrait;
use Lib\managers\ArticleManager;

class Controller extends ControllerTrait
{
	private $manager;

	public function __construct()
	{
		parent::__construct();
		$this->manager = new ArticleManager($this->getDB());
	}

	public function indexAction()
	{
		echo $this->getTwig()->render('index.html.twig');
	}

	public function articlesAction()
	{
		$articles = $this->manager->getArticles();
		echo $this->getTwig()->render('articles.html.twig', ['articles' => $articles]);
	}

	public function articleDetailAction()
	{
		$article = $this->manager->getArticle($id);
		echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article]);
	}
}