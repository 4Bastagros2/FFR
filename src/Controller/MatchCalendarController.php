<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCalendarController extends AbstractController
{
    /**
     * @Route("/match/calendar", name="match_calendar")
     */
    public function index(MatchRepository $match, MatchTypeRepository $type)
    {
        $matchtype = $match->find(1);
        $visitorteam = $match->find(1);
        $date = $match->find(1)->getDate()->format('Y-m-d H:i:s');
        

        $type = $matchtype->getMatchType()->getName();
        $visitor = $visitorteam->getVisitorTeam();
        $local = $visitorteam->getLocalTeam();
     
        return $this->render('match_calendar/index.html.twig', [
            'controller_name' => 'MatchCalendarController',
            'match_type' => $type,
            'visitor' =>$visitor,
            'local'=>$local,
            'date'=>$date
        ]);
    }
}
