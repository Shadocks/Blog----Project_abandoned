<?php

namespace Lib\managers;

use Core\DBFactory;
use Lib\entity\Article;

class ArticleManager
{
	private $db;

	public function __construct(DBFactory $db)
	{
		$this->db = $db->getConnexion();
	}
	
	public function ajouterArticle(Article $article)
	{
		$req = $this->db->prepare('
			INSERT INTO article (titre, chapo, date_creation, contenu, auteur) 
			VALUES (NULL, :titre, :chapo, NOW(), :auteur)
		');

		$req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
		$req->bindValue(':chapo', $article->getChapo(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $article->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':auteur', $article->getAuteur(), PDO::PARAM_STR);

		$req->execute();
	}

	public function getArticles()
	{
		$articles = [];

		$art = $this->db->query('
			SELECT id, titre, chapo, date_creation, date_modification, contenu, auteur 
			FROM article 
			ORDER BY id DESC
		');

		while($donnees = $art->fetch()){
			$articles[] = $donnees;
		}

		return $articles;
	}

	public function getArticle()
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

		$req = $this->db->prepare('UPDATE article SET titre = :titre, chapo = :chapo, date_creation = :datec, date_modification = :datem, contenu = :contenu, auteur = :auteur WHERE id = :id');

		$req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
		$req->bindValue(':chapo', $article->getChapo(), PDO::PARAM_STR);
		$req->bindValue(':datec', $article->getDateCreation(), PDO::PARAM_STR);
		$req->bindValue(':datem', $article->getDateModification(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $article->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':auteur', $article->getAuteur(), PDO::PARAM_STR);
		$req->bindValue(':id', $article->getId(), PDO::PARAM_STR);

		$req->execute();
	}

	public function deleteArticle(Article $article)
	{

		$req = $this->db->prepare('DELETE * FROM article WHERE id = :id LIMIT 1');

		$req->bindValue(':id', $article->getId(), PDO::PARAM_INT);

		$req->execute();
	}	
}