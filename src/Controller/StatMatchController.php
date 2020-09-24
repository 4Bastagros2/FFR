<?php

namespace App\Controller;

use App\Entity\Match;
use App\Form\MatchStatsType;
use App\Form\AddMatchFormType;
use App\Entity\PlayerMatchStats;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
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
        // dump($match);
        $local = $match->getLocalTeam();
        //affiche team visiteur
        $visitor = $match->getVisitorTeam();
        //affiche type de match
        $type = $match->getMatchType();
        $type_name = $type->getName();
        $teams = $match->getTeams();





        $recScore = $match->getRecScore();
        $visitorScore = $match->getVisiteurScore();





        $yellows = $match->getYellows();
        $essais = $match->getEssais();
        $transformations = $match->getTransformations();
        $penalites = $match->getPenalites();
        $drops = $match->getDrops();
       
        $team = $teams[0];
        $team_id = $team->getId();
       
        $joueurs = $team->getPlayers();

        foreach($joueurs as $j)
        {
            $j->setCurrentMatch($id);
        }

        $mergedForms = [
            'match'     =>      $match,
            'players'   =>      $joueurs,
        ];

        $form = $this->createForm(MatchStatsType::class, $match);
        $form->submit($request->request->get('match_stats'), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Ajouté avec succes !');
            
            // $data=$task->getViewData();
            $task = $form->getData();

            // $match->setRecScore($task->getRecScore']);
            // $match->setVisiteurScore($task['visiteurScore']);
            
            // dump($task);

            // dump($task['recScore']);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            // foreach($joueurs as $j)
            // {
                // $entityManager->persist($j);
            

            $entityManager->flush();

            return $this->redirectToRoute('match_calendar',array(
                'id_team' => $team_id,
            ));
        }
        // $Match->setScore(score)
        
        
        
        
        
        return $this->render('stat_match/index.html.twig', [
            'form' => $form->createView(),
            'idteam' => $team->getId(),
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
