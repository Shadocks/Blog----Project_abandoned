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
		if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['auteur']) && isset($_POST['contenu'])) {
				$value = ['titre' => $_POST['titre'], 'chapo' => $_POST['chapo'], 'auteur' => $_POST['auteur'], 'contenu' => $_POST['contenu']];
					$article = $this->manager->buildArticle($value);
						$this->manager->ajouterArticle($article);
							echo $this->getTwig()->render('ecrireArticle.html.twig');
		} else {
			echo $this->getTwig()->render('ecrireArticle.html.twig');
		}
	}

	public function updateArticleAction()
	{
		if (isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['auteur']) && isset($_POST['contenu'])) {
			$value = ['titre' => $_POST['titre'], 'chapo' => $_POST['chapo'], 'auteur' => $_POST['auteur'], 'contenu' => $_POST['contenu'], 'id' => $_POST['id']];
				$article = $this->manager->buildArticle($value);
					$this->manager->modificationArticle($article);
						echo $this->getTwig()->render('modificationArticle.html.twig');
		} else {
			$article = $this->manager->getArticle();
				echo $this->getTwig()->render('modificationArticle.html.twig', ['article' => $article]);			
		}		
	}

	public function deleteArticleAction()
	{
		if (isset($_GET['id'])) {
			$value = ['id' => $_GET['id']];
				$article = $this->manager->buildArticle($value);
					$this->manager->deleteArticle($article);
						echo $this->getTwig()->render('index.html.twig');
		}
	}
}