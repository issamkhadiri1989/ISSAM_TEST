<?php
namespace Exo;

class Carte
{

    private $_categorie, $_valeur, $_i, $_j;

    function __construct($cat, $val)
    {
        $this->_categorie = $cat;
        $this->_valeur = $val;
        $this->_i = $this->Valeur($val);
        $this->_j = $this->Categorie($cat);
    }

    /**
     *
     * @return the $_j
     */
    public function getJ()
    {
        return $this->_j;
    }

    /**
     *
     * @param number $_j            
     */
    public function setJ($_j)
    {
        $this->_j = $_j;
    }

    public function Valeur($Nom)
    {
        switch ($Nom) {
            case "ACE":
                return 1;
            case "TWO":
                return 2;
            case "THREE":
                return 3;
            case "FOUR":
                return 4;
            case "FIVE":
                return 5;
            case "SIX":
                return 6;
            case "SEVEN":
                return 7;
            case "EIGHT":
                return 8;
            case "NINE":
                return 9;
            case "TEN":
                return 10;
            case "JACK":
                return 11;
            case "QUEEN":
                return 12;
            case "KING":
                return 13;
            default:
                return - 1;
        }
    }

    /**
     *
     * @return the $_categorie
     */
    public function getCategorie()
    {
        return $this->_categorie;
    }

    /**
     *
     * @return the $_valeur
     */
    public function getValeur()
    {
        return $this->_valeur;
    }

    /**
     *
     * @return the $_i
     */
    public function getI()
    {
        return $this->_i;
    }

    /**
     *
     * @param field_type $_categorie            
     */
    public function setCategorie($_categorie)
    {
        $this->_categorie = $_categorie;
    }

    /**
     *
     * @param field_type $_valeur            
     */
    public function setValeur($_valeur)
    {
        $this->_valeur = $_valeur;
    }

    /**
     *
     * @param number $_i            
     */
    public function setI($_i)
    {
        $this->_i = $_i;
    }

    public function Categorie($cat)
    {
        switch ($cat) {
            case "DIAMOND":
                return 0;
            case "HEART":
                return 1;
            case "SPADE":
                return 2;
            case "CLUB":
                return 3;
            default:
                return - 1;
        }
    }

    public static function Carte_Par_Valeur($valeur)
    {
        switch ($valeur) {
            case 1:
                return "ACE";
            case 2:
                return "TWO";
            case 3:
                return "THREE";
            case 4:
                return "FOUR";
            case 5:
                return "FIVE";
            case 6:
                return "SIX";
            case 7:
                return "SEVEN";
            case 8:
                return "EIGHT";
            case 9:
                return "NINE";
            case 10:
                return "TEN";
            case 11:
                return "JACK";
            case 12:
                return "QUEEN";
            case 13:
                return "KING";
            default:
                return null;
        }
    }

    public static function Carte_Par_Categorie($cat)
    {
        switch ($cat) {
            case 0:
                return "DIAMOND";
            case 1:
                return "HEART";
            case 2:
                return "SPADE";
            case 3:
                return "CLUB";
            default:
                return null;
        }
    }
}

