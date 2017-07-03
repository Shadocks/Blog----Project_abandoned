<?php

namespace Lib;

use Core\DBFactory;

class ArticleManager
{
	private $db;

	public function __construct()
	{
		$this->loadDBFactory();
		$this->db = new DBFactory();
	}
	
	public function loadDBFactory()
	{
		$this->db = require __DIR__.'./etc/DBFactory.php';
	}
	
	public function ajouterArticle(Article $article)
	{
		$req = $this->db->prepare('
			INSERT INTO article (titre, chapo, date_creation, date_modification, contenu, auteur) 
			VALUES (NULL, :titre, :chapo, :datec, :datem, :contenu, :auteur)
		');

		$req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
		$req->bindValue(':chapo', $article->getChapo(), PDO::PARAM_STR);
		$req->bindValue(':datec', $article->getDateCreation(), PDO::PARAM_STR);
		$req->bindValue(':datem', $article->getDateModification(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $article->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':auteur', $article->getAuteur(), PDO::PARAM_STR);

		$req->execute();
	}

	public function getArticles()
	{
		$articles = [];

		$art = $this->db->query('
			SELECT titre, chapo, date_creation, date_modification, contenu, auteur 
			FROM article 
			ORDER BY id DESC
		');

		while($donnees = $art->fetch()){
			$articles[] = $donnees;
		}

		return $articles;
	}

	public function getArticle($db)
	{
		$art = $this->db->prepare('SELECT * FROM article WHERE id = ?');
		$art->execute(array($_GET['id']));

		while($donnees = $art->fetch()){
			$article = $donnees;
		}

		return $article;
	}

	public function modificationArticle(Article $article)
	{

		// Requête préparée

		$req = $this->db->prepare('UPDATE article SET titre = :titre, chapo = :chapo, date_creation = :datec, date_modification = :datem, contenu = :contenu, auteur = :auteur WHERE id = :id');

		// Association des valeurs aux paramètres

		$req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
		$req->bindValue(':chapo', $article->getChapo(), PDO::PARAM_STR);
		$req->bindValue(':datec', $article->getDateCreation(), PDO::PARAM_STR);
		$req->bindValue(':datem', $article->getDateModification(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $article->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':auteur', $article->getAuteur(), PDO::PARAM_STR);
		$req->bindValue(':id', $article->getId(), PDO::PARAM_STR);

		// Execution de la requête

		$req->execute();
	}

	public function supprimerArticle(Article $article)
	{

		// Requête préparée

		$req = $this->db->prepare('DELETE * FROM article WHERE id = :id LIMIT 1');

		// Association 

		$req->bindValue(':id', $article->getId(), PDO::PARAM_INT);

		// Execution de la requête

		$req->execute();
	}	
}

$am = new ArticleManager();
var_dump($am);

$am->getArticles();