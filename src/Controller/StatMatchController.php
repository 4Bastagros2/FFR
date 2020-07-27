<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;

class StatMatchController extends AbstractController
{
    /**
     * @Route("/stat/match/{id}", name="stat_match")
     */
    public function index(MatchRepository $Match, MatchTypeRepository $Type,$id)
    {   
        //affiche team local
        $team = $Match->find($id);
        $local=$team->getLocalTeam();
        //affiche team visiteur
        $visitor=$team->getVisitorTeam();
        //affiche type de match
        $idType=$team->getMatchType();
        $matchType=$Type->find($idType);
        $type=$matchType->getName();

        $theTeam = $team->getTeams();
        dump($theTeam[0]);

        //affiche score
        $tmp=$team->getStats();
        $score=$tmp[0]["score"];
        //affiche carton rouge
        $red=$tmp[1]["red"];
        //affiche carton jaune
        $yellow=$tmp[2]["yellow"];
        //affiche essais
        $essais=$tmp[3]["essais"];
        //affiche transformation
        $trans=$tmp[4]["transformation"];
        //affiche penalite
        $penalite=$tmp[5]["penalite"];
        //affiche drops
        $drops=$tmp[6]["drops"];
       
    
        return $this->render('stat_match/index.html.twig', [
            'local_team'=>$local,
            'visitor_team'=>$visitor,
            'match_type'=>$type,
            'score'=>$score,
            'red'=>$red,
            'yellow'=>$yellow,
            'essais'=>$essais,
            'transformation'=>$trans,
            'penalite'=>$penalite,
            'drops'=>$drops
            
        ]);
    }
}
