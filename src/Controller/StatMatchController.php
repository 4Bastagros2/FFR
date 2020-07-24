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
        

        //test
        $team = $Match->find($id);
        $local=$team->getLocalTeam();
        $visitor=$team->getVisitorTeam();
        $idType=$team->getMatchType();
        $matchType=$Type->find($idType);
        $type=$matchType->getName();
        
    
        return $this->render('stat_match/index.html.twig', [
            
            'local_team'=>$local,
            'visitor_team'=>$visitor,
            'match_type'=>$type
        ]);
    }
}
