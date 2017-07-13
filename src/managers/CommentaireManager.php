<?php

namespace Lib\managers;

use Core\DBFactory;

class CommentaireManager
{
	private $db;

	public function __construct(DBFactory $db)
	{
		$this->db = $db->getConnexion();
	}

	public function getCommentaires()
	{
		$commentaires = [];

		$com = $this->db->prepare('SELECT * FROM commentaire WHERE Article_id AS id = ?');
		$com->execute(array($_GET['id']));

		while($donnees = $com->fetch()){
			$commentaires[] = $donnees;
		}

		return $commentaires;
	}

	public function ajouterCommentaire(Commentaire $commentaire)
	{
		$req = $this->db->prepare('INSERT INTO commentaire (auteur, date_creation, contenu, Article_id) VALUES (NULL, :auteur, :datec, :contenu, :articleId)');

		$req->bindValue(':auteur', $commentaire->getAuteur(), PDO::PARAM_STR);
		$req->bindValue(':datec', $commentaire->getDateCreation(), PDO::PARAM_STR);
		$req->bindValue(':contenu', $commentaire->getContenu(), PDO::PARAM_STR);
		$req->bindValue(':articleId', $commentaire->getArticleId(), PDO::PARAM_INT);

		$req->execute();
	}
}