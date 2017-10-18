<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
require_once 'vendor/Exo/Joueur.php';
use Exo\Joueur;
require_once 'vendor/Exo/Jeu.php';
use Exo\Jeu;
require_once 'vendor/Exo/Carte.php';
use Exo\Carte;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $jeu = [];
        
        $resp = $this->UrlTestRequete();
        
        $json = new \Zend\Json\Json();
        ini_set('xdebug.var_display_max_depth', '10');
        $resp = $json->decode($resp);
        
        $c = $resp->data->cards;
        
        /* Initialiser un Joueur */
        $Joueur = new Joueur($resp->candidate->candidateId, $resp->candidate->lastName, $resp->candidate->firstName);
        
        /* Initialiser un jeu */
        $Jeu = new Jeu($resp->exerciceId, $Joueur, (new \DateTime())->setTimestamp((double) $resp->dateCreation));
        $Jeu->setCategoryOrder($resp->data->categoryOrder);
        $Jeu->setValueOrder($resp->data->valueOrder);
        
        /* Ajouter les cartes au jeu */
        foreach ($resp->data->cards as $v) {
            $Jeu->AjouterNouvelleCarte(new Carte($v->category, $v->value));
        }
        
        /* Trier les cartes */
        $Jeu->Trier_Les_Cartes();
        
        /* Recupérer le jeu trié */
        $Resultat = $Jeu->JeuTrie();
        
        
        
        return array(
            "JeuNonTrie" => $c,
            'JeuTrie' => $Resultat,
            'resp' => $resp ,
        );
    }

    private function UrlTestResult($exerciceId)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://recrutement.local-trust.com/test/{$exerciceId}",
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0C',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                 
            )
        ));
        /* Fixer le problèmes du HTTPS */
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
    
    
    /* Récupérer le TEST */
    private function UrlTestRequete()
    {
        /* Initialisation du cUrl */
        $curl = curl_init();
        
        /* Définir les options de base du cURL */
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://recrutement.local-trust.com/test/cards/57187b7c975adeb8520a283c',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0C'
        ));
        /* Fixer le problèmes du HTTPS */
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        /* Executer la requête GET */
        $resp = curl_exec($curl);
        
        if ($resp === FALSE) {
            throw new \Exception("ERROR  : " . curl_error($curl), 500);
        } else {
            curl_close($curl);
            return $resp;
        }
    }
}
