<?php
namespace Exo;

require_once 'vendor/Exo/Joueur.php';

class Jeu
{

    private $categoryOrder, $valueOrder;

    private $_idExercice;

    private $_dateCreation;

    private $_joueur;

    private $_distibution;

    /**
     *
     * @param field_type $categoryOrder            
     */
    public function setCategoryOrder($categoryOrder)
    {
        $this->categoryOrder = $categoryOrder;
    }

    /**
     *
     * @param field_type $valueOrder            
     */
    public function setValueOrder($valueOrder)
    {
        $this->valueOrder = $valueOrder;
    }

    function __construct($idExercice, Joueur $joueur, \DateTime $dateCreation)
    {
        $this->_idExercice = $idExercice;
        $this->_dateCreation = $dateCreation;
        $this->_joueur = $joueur;
        $this->_distibution = [];
    }

    /**
     *
     * @return the $_idExercice
     */
    public function getIdExercice()
    {
        return $this->_idExercice;
    }

    /**
     *
     * @return the $_dateCreation
     */
    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    /**
     *
     * @return the $_joueur
     */
    public function getJoueur()
    {
        return $this->_joueur;
    }

    /**
     *
     * @return the $_distibution
     */
    public function getDistibution()
    {
        return $this->_distibution;
    }

    /**
     *
     * @param field_type $_idExercice            
     */
    public function setIdExercice($_idExercice)
    {
        $this->_idExercice = $_idExercice;
    }

    /**
     *
     * @param \\DateTime $_dateCreation            
     */
    public function setDateCreation($_dateCreation)
    {
        $this->_dateCreation = $_dateCreation;
    }

    /**
     *
     * @param \Exo\Joueur $_joueur            
     */
    public function setJoueur($_joueur)
    {
        $this->_joueur = $_joueur;
    }

    /**
     * Ajouter une nouvelle Carte à la distribution
     *
     * @param Carte $carte            
     * @return \Exo\Jeu
     */
    public function AjouterNouvelleCarte(Carte $carte)
    {
        $this->_distibution[] = $carte;
        return $this;
    }

    /**
     * Trier les cartes
     */
    public function Trier_Les_Cartes()
    {
        $cartes = [];
        foreach ($this->_distibution as $carte) {
            $cartes[] = array(
                "categorie" => $carte->getJ(),
                "valeur" => $carte->getI()
            );
        }
        $categories = $valeurs = [];
        foreach ($cartes as $key => $row) {
            $categories[$key] = $row['categorie'];
            $valeurs[$key] = $row['valeur'];
        }
        array_multisort($categories, SORT_ASC, $valeurs, SORT_ASC, $cartes);
        foreach ($cartes as $key => $data) {
            $cartes[$key]['valeur'] = Carte::Carte_Par_Valeur($data['valeur']);
            $cartes[$key]['categorie'] = Carte::Carte_Par_Categorie($data['categorie']);
        }
        $this->_distibution = $cartes;
    }

    public function JeuTrie()
    {
        $stdClass = new \stdClass();
        $stdClass->cards = [];
        foreach ($this->_distibution as $Carte) {
            $carteStd = new \stdClass();
            $carteStd->category = $Carte['categorie'];
            $carteStd->value = $Carte['valeur'];
            $stdClass->cards[] = $carteStd;
        }
        $stdClass->valueOrder = $this->valueOrder;
        $stdClass->categoryOrder = $this->categoryOrder;
        return $stdClass;
    }
}

