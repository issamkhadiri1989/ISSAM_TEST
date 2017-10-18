<?php
namespace Exo;

class Joueur
{

    private $_id, $_nom, $_prenom;

    function __construct($id, $nom, $prenom)
    {
        $this->_id = $id;
        $this->_nom = $nom;
        $this->_prenom = $prenom;
    }

    /**
     *
     * @return the $_id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     *
     * @return the $_nom
     */
    public function getNom()
    {
        return $this->_nom;
    }

    /**
     *
     * @return the $_prenom
     */
    public function getPrenom()
    {
        return $this->_prenom;
    }

    /**
     *
     * @param field_type $_id            
     */
    public function setId($_id)
    {
        $this->_id = $_id;
    }

    /**
     *
     * @param field_type $_nom            
     */
    public function setNom($_nom)
    {
        $this->_nom = $_nom;
    }

    /**
     *
     * @param field_type $_prenom            
     */
    public function setPrenom($_prenom)
    {
        $this->_prenom = $_prenom;
    }
}

