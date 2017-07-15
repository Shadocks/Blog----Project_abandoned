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
				if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])) {
					mail('mickael.bardeau@laposte.net', 'Formulaire de contact via blog', $_POST['message']);
						echo $this->getTwig()->render('test.html.twig');
				} 
		var_dump($_POST);
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
		echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article, 'commentaires' => $commentaires]);
	}

	public function addArticleAction()
	{
		echo $this->getTwig()->render('ecrireArticle.html.twig');
			if (isset($_GET['titre']) && isset($_GET['chapo']) && isset($_GET['auteur']) && isset($_GET['contenu'])) {
				$this->manager->ajouterArticle(Article);
			}
	}

	public function updateArticleAction()
	{
		$article = $this->manager->getArticle();
		echo $this->getTwig()->render('modificationArticle.html.twig', ['article' => $article]);
	}
}