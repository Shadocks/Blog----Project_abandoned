<?php

/**
* Classe gérant les commentaires.
* @author Mickael B.
* @version 1.0
*/

class CommentaireManager
{

	/**
	* @var PDO $db
	*/
	private $_db;


	/**
	* Initialisation de la connexion à la bdd.
	* @param $db
	*/
	public function __construct($db)
	{
		$this->setDb($db);
	}


	/**
	* Setter
	* @param $db
	*/
	public function setDb($db)
	{
		$this->_db = $db;
	}


	/** 
	* CREATE
	* Ajoute un commentaire à la BDD.
	* @param Commentaire $commentaire
	* @return
	*/
	public function ajouterCommentaire(Commentaire $commentaire)
	{
		$req = $this->_db->prepare('INSERT INTO commentaire (auteur, date_creation, contenu, Article_id) VALUES (NULL, :auteur, :datec, :contenu, :articleId)');

		$req->bindValue(':auteur', $commentaire->getAuteur(), PDO::PARAM_STR);
		$req->bindValue(':datec', $commentaire->getDateCreation(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $commentaire->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':articleId', $commentaire->getArticleId(), PDO::PARAM_INT);
		

		$req->execute();
	}


	/**
	* READ ALL
	* Récupérer tout les Commentaires d'un article.
	* @param $articleId
	* @return array
	*/
	public function getCommentaires($articleId)
	{
		$commentaires = [];

		$com = $db->prepare('SELECT * FROM article WHERE Article_id AS articleId = ?');
		$com->execute(array($_GET['articleId']));

		while($donnees = $com->fetch()){
			$commentaire [] = $donnees;
		}

		return $article;
	}