<?php

namespace Lib\entity;

/**
* Classe définissant un commentaire.
* @author Mickael B.
* @version 1.0
*/

class Commentaire
{
	protected $id;
	protected $auteur;
	protected $dateCreation;
	protected $contenu;
	protected $articleId;

/**
* Constructeur
* @param $donnees array
* @return void
*/
	public function __construct(array $commentaire)
	{
		$this->hydrate($commentaire);
	}

/**
* Hydratation
* @param $commentaire array
* @return 
*/
	public function hydrate(array $commentaire)
	{
		foreach ($commentaire as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

// Getters

	public function getId()
	{
		return $this->id;
	}

	public function getAuteur()
	{
		return $this->auteur;
	}

	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	public function getContenu()
	{
		return $this->contenu;
	}

	public function getArticleId()
	{
		return $this->articleId;
	}



// Setters

	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function setAuteur($auteur)
	{
		if (is_string($auteur) && (strlen($auteur) <= 255)) {
			$this->auteur = $auteur;
		}
	}

	public function setDateCreation($dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

	public function setContenu($contenu)
	{
		if (is_string($contenu)) {
			$this->contenu = $contenu;
		}
	}

	public function setArticleId($articleId)
	{
		return $this->articleId = (int) $articleId;
	}
}