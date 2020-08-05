<?php

namespace App\Controller;

use App\Entity\Match;
use App\Form\MatchStatsType;
use App\Form\AddMatchFormType;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StatMatchController extends AbstractController
{
    /**
     * @Route("/stat/match/{id}", name="stat_match")
     */
    public function index(MatchRepository $matchRep, MatchTypeRepository $Type,TeamRepository $teamMatch, Request $request, SluggerInterface $slugger, $id)
    {   
        //affiche team local
        $match = $matchRep->find($id);
        dump($match);
        $local = $match->getLocalTeam();
        //affiche team visiteur
        $visitor = $match->getVisitorTeam();
        //affiche type de match
        $type = $match->getMatchType();
        $type_name = $type->getName();
        $teams = $match->getTeams();
        $score = $match->getScore();
        $reds = $match->getReds();
        $yellows = $match->getYellows();
        $essais = $match->getEssais();
        $transformations = $match->getTransformations();
        $penalites = $match->getPenalites();
        $drops = $match->getDrops();
       
        $team = $teams[0];
        $team_id = $team->getId();
       
        $joueurs = $team->getPlayers();

        // $Match = new Match();
        $form = $this->createForm(MatchStatsType::class, $match);
        // $form->handleRequest($request);
        $form->submit($request->request->get('match_stats'), false);

        if ($form->isSubmitted() && $form->isValid()) {


            
            // $data=$task->getViewData();
            
            // $task=$form->getData();


        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();


        }
        // $Match->setScore(score)
        
        
        
        
        
        return $this->render('stat_match/index.html.twig', [
            'form' => $form->createView(),
            // 'local_team'=>$local,
            // 'visitor_team'=>$visitor,
            // 'match_type'=>$type,
            // 'score'=>$score,
            // 'red'=>$red,
            // 'yellow'=>$yellow,
            // 'essais'=>$essais,
            // 'transformation'=>$trans,
            // 'penalite'=>$penalite,
            // 'drops'=>$drops,
            // 'joueur'=>$joueurs
        ]);
    }
}
