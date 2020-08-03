<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TeamRepository;

class MatchCalendarController extends AbstractController
{
    /**
     * @Route("/match/calendar/{id_team}", name="match_calendar")
     */
    public function index(MatchRepository $match, MatchTypeRepository $type,TeamRepository $team,$id_team)
    {
        $match=$team->find($id_team)->getPlayMatches();
        $match_id=$team->find($id_team);
        
       

        
        return $this->render('match_calendar/index.html.twig', [
            'match'=>$match,
            'match_id'=>$match_id
        ]);
    }
}
