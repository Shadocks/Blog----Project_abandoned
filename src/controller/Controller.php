<?php

namespace Lib\controller;

use Lib\controller\core\ControllerTrait;
use Lib\managers\ArticleManager;
use Lib\managers\CommentaireManager;

class Controller extends ControllerTrait
{
	private $manager;

	private $managerC;

	public function __construct()
	{
		parent::__construct();
		$this->manager = new ArticleManager($this->getDB());
		$this->managerC = new CommentaireManager($this->getDB());
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
		$article = $this->manager->getArticle();
		$commentaires = $this->managerC->getCommentaires();
		echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article], ['commentaires' => $commentaires]);
		echo '<pre>';
		print_r($commentaires);
		echo '</pre>';
	}

	public function formAction()
	{
		echo $this->getTwig()->render('formulaire.html.twig');
	}

	public function addArticleAction()
	{
		echo $this->getTwig()->render('ecrireArticle.html.twig');
	}

	public function updateArticleAction()
	{
		$article = $this->manager->getArticle();
		echo $this->getTwig()->render('modificationArticle.html.twig', ['article' => $article]);
	}
}