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

        //affiche score
        $tmp=$team->getStats();
        $score=$tmp[0]["score"];
       
        
    
        return $this->render('stat_match/index.html.twig', [
            
            'local_team'=>$local,
            'visitor_team'=>$visitor,
            'match_type'=>$type,
            'score'=>$score
        ]);
    }
}
