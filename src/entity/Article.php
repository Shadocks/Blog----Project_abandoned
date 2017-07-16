<?php

namespace Lib\entity;

/**
* Classe définissant un article.
* @author Mickael B.
* @version 1.0
*/

class Article
{
	protected $id;
	protected $titre;
	protected $chapo;
	protected $dateCreation;
	protected $dateModification;
	protected $contenu;
	protected $auteur;

/**
* Constructeur permettant d'initialiser les objets article 
* @param $donnees array
* @return
*/

	public function __construct(array $article)
	{
		$this->hydrate($article);
	}

/**
* Méthode permettant d'hydrater les objets Article
* @param $article array
* @return 
*/

	public function hydrate(array $article)
	{
		foreach($article as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

// Getters / Récupère la valeur d'un attribut

	public function getId()
	{
		return $this->id;
	}

	public function getTitre()	
	{
		return $this->titre;
	}

	public function getChapo()
	{
		return $this->chapo;
	}

	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	public function getDateModification()
	{
		return $this->dateModification;
	}

	public function getContenu()
	{
		return $this->contenu;
	}

	public function getAuteur()
	{
		return $this->auteur;
	}

// Setters / Modifie la valeur d'un attribut

	public function setId($id)
	{
		$this->id = (int) $id; // $this->id = intval($id);
	}

	public function setTitre($titre)	
	{
		if (is_string($titre) && strlen($titre) <= 255) {
			$this->titre = $titre;
		}
	}

	public function setChapo($chapo)
	{
		if (is_string($chapo)) {
			$this->chapo = $chapo;
		}
	}

	public function setDateCreation(DateTime $dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}

	public function setDateModification(DateTime $dateModification)
	{
		$this->dateModification = $dateModification;
	}

	public function setContenu($contenu)
	{
		if (is_string($contenu)) {
			$this->contenu = $contenu;
		}
	}

	public function setAuteur($auteur)
	{
		if (is_string($auteur) && (strlen($auteur) <= 255)) {
			$this->auteur = $auteur;
		}
	}
}