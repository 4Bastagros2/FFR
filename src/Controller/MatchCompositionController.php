<?php

namespace App\Controller;

use App\Entity\Match;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCompositionController extends AbstractController
{

    private $composition;

    /**
     * @Route("/match/composition/{id_match}", name="match_composition")
     */
    public function index(MatchRepository $matchRep, $id_match)
    {
        


        $match=$matchRep->find($id_match);

        if(date("Y-m-d H:i:s") > $match->getDate())
            return $this->redirect($this->generateUrl('stats_match'));


        $compo = $match->getComposition();

        // dump($compo);

        $team = $match->getTeams()[0];
        $players = $team->getPlayers();

        $bench = [];

        foreach ($players as $player)
        {
                if(!in_array($player->getId(), $compo))
                {
                    dump('player in bench'.$player->getId());
                    $bench[] = $player;
                }
        }

        // dump($players);
        // dump($bench);
        dump(json_encode($bench));
        

        return $this->render('match_composition/index.html.twig', [
            'controller_name' => 'MatchCompositionController',
            'id_match' => $id_match,
            'players' => $players,
            'bench' => $bench,
            'composition' => json_encode($compo),
        ]);
    }


    /**
     * @Route("/match/composition/update/{id_match}", name="match_composition_update")
     */
    public function update(Request $request, MatchRepository $matchRep, $id_match) {
        $entityManager = $this->getDoctrine()->getManager();
        
        dump($request);
        $match=$matchRep->find($id_match);
        $compo = json_decode($request->request->get('composition'));
        $match->setComposition($compo);
        dump($compo);
        
        $entityManager->persist($match);
        $entityManager->flush();

        $response = new Response();
        return $response;
      }
}
