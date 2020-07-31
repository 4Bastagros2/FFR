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
     * @Route("/match/update/composition/{id_match}", name="match_composition")
     */
    public function index(MatchRepository $matchRep, $id_match)
    {
        
        $match=$matchRep->find($id_match);

        return $this->render('match_composition/index.html.twig', [
            'controller_name' => 'MatchCompositionController',
            'id_match' => $id_match,
        ]);
    }


    /**
     * @Route("/match/composition/update/{id}", methods={"POST"})
     */
    public function update(Request $request, MatchRepository $matchRep, $id) {

        $match=$matchRep->find($id_match);
        $manager->setComposition($request   );
        
        $manager->flush();
        $response = new Response();
        return $response;
      }
}
