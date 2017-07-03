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
	private $_titre;
	private $_chapo;
	private $_dateCreation;
	private $_dateModification;
	private $_contenu;
	private $_auteur;


/**
* Constructeur permettant d'initialiser les objets article 
* @param $donnees array
* @return
*/
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}


/**
* Méthode permettant d'hydrater les objets Article
* @param $article array
* @return 
*/
	public function hydrate(array $article)
	{
		foreach($article as $key => $value) {
			$method = 'set'.ucfirst($key);			// méthode = setId()
			if(method_exists($this, $method)) {		// if (objet, setId) true / Vérifie si la méthode existe pour l'objet fourni
				$this->$method($value);				// ($this->setId(1))
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
		return $this->_titre;
	}

	public function getChapo()
	{
		return $this->_chapo;
	}

	public function getDateCreation()
	{
		return $this->_dateCreation;
	}

	public function getDateModification()
	{
		return $this->_dateModification;
	}

	public function getContenu()
	{
		return $this->_contenu;
	}

	public function getAuteur()
	{
		return $this->_auteur;
	}

// Setters / Modifie la valeur d'un attribut

	public function setId($id)
	{
		$this->id = (int) $id; // $this->id = intval($id);
	}

	public function setTitre($titre)	
	{
		if (is_string($titre) && strlen($titre) <= 255) {
			$this->_titre = $titre;
		}
	}

	public function setChapo($chapo)
	{
		if (is_string($chapo)) {
			$this->_chapo = $chapo;
		}
	}

	public function setDateCreation($dateCreation)
	{
		$this->_dateCreation = $dateCreation;
	}

	public function setDateModification($dateModification)
	{
		$this->_dateModification = $dateModification;
	}

	public function setContenu($contenu)
	{
		if (is_string($contenu)) {
			$this->_contenu = $contenu;
		}
	}

	public function setAuteur($auteur)
	{
		if (is_string($auteur) && (strlen($ateur) <= 255)) {
			$this->_auteur = $auteur;
		}
	}
}