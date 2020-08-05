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
    public function index(MatchRepository $Match, MatchTypeRepository $Type,TeamRepository $teamMatch, Request $request, SluggerInterface $slugger, $id)
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
        // $tmp=$team->getStats()[0];
        // dump($tmp);
        // $score=$tmp["score"];
        // //affiche carton rouge
        // $red=$tmp[1]["red"];
        // //affiche carton jaune
        // $yellow=$tmp[2]["yellow"];
        // //affiche essais
        // $essais=$tmp[3]["essais"];
        // //affiche transformation
        // $trans=$tmp[4]["transformation"];
        // //affiche penalite
        // $penalite=$tmp[5]["penalite"];
        // //affiche drops
        // $drops=$tmp[6]["drops"];
       
        $theTeam = $team->getTeams()[0]->getId();
       
        $joueurs=$teamMatch->find($theTeam)->getPlayers();

        $Match = new Match();
        $form = $this->createForm(MatchStatsType::class, $Match);
        // $form->handleRequest($request);
        $form->submit($request->request->get('match_stats'), false);

        if ($form->isSubmitted() && $form->isValid()) {


            
            // $data=$task->getViewData();
            
            // $task=$form->getData();


        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Match);
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
