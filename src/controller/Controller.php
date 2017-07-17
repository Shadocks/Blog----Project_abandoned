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
		//echo '<pre>';
		//var_dump($_SERVER);
		//var_dump($_GET);
		//echo '</pre>';
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
		if (isset($_POST['auteur']) && isset($_POST['contenu']) && isset($_GET['id'])) {
			$value = ['auteur' => $_POST['auteur'], 'contenu' => $_POST['contenu'], 'articleId' => $_GET['id']];
				$commentaire = $this->managerC->buildCommentaire($value);
					$this->managerC->ajouterCommentaire($commentaire);
						$id = (int) $_GET['id'];
							$article = $this->manager->getArticle($id);
								$commentaires = $this->managerC->getCommentaires();
									echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article, 'commentaires' => $commentaires]);
		} elseif (isset($_GET['id'])) {
			$id = (int) $_GET['id'];
				$article = $this->manager->getArticle($id);
					$commentaires = $this->managerC->getCommentaires();
						echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article, 'commentaires' => $commentaires]);
		}
	}

	public function addArticleAction()
	{
		if (isset($_POST['titre']) && isset($_POST['chapo']) && isset($_POST['auteur']) && isset($_POST['contenu'])) {
				$value = ['titre' => $_POST['titre'], 'chapo' => $_POST['chapo'], 'auteur' => $_POST['auteur'], 'contenu' => $_POST['contenu']];
					$article = $this->manager->buildArticle($value);
						$this->manager->ajouterArticle($article);
							unset($article);
								$articles = $this->manager->getArticles();
									echo $this->getTwig()->render('articles.html.twig', ['articles' => $articles]);
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
						unset($article);
							$article = $this->manager->getArticle();
								$commentaires = $this->managerC->getCommentaires();
									echo $this->getTwig()->render('articleDetail.html.twig', ['article' => $article, 'commentaires' => $commentaires]);
		} elseif (isset($_GET['id'])) {
			$id = (int) $_GET['id'];
				$article = $this->manager->getArticle($id);
					echo $this->getTwig()->render('modificationArticle.html.twig', ['article' => $article]);			
		}		
	}

	public function deleteArticleAction()
	{
		if (isset($_GET['id'])) {
			$value = ['id' => $_GET['id']];
				$article = $this->manager->buildArticle($value);
					$this->manager->deleteArticle($article);
							$articles = $this->manager->getArticles();
								echo $this->getTwig()->render('articles.html.twig', ['articles' => $articles]);
		}
	}
}