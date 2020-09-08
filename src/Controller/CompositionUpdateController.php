<?php

namespace App\Controller;

use App\Entity\Match;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompositionUpdateController extends AbstractController
{

    private $composition;

    /**
     * @Route("/match/composition/update/{id_match}", name="match_composition_update")
     */
    public function update(Request $request, MatchRepository $matchRep, $id_match) {
        // if ($request->isXmlHttpRequest() ||  $request->request->get('composition') == 1)
        // {

            
            $entityManager = $this->getDoctrine()->getManager();
            
            dump($request);
            $match=$matchRep->find($id_match);
            // $compo = json_decode($request->request->get('composition'));
            $compo = $request->request->get('composition');
        //     dump($composition);
        //     // $compo = json_decode('[{"banc":[36,32],"compo":[0,0,0,0,17,37,0,32,0,0,0,0,0,0,0,0],"selected":[1]},{"banc":[0,0,0,0,0,0,0],"compo":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"selected":[]},{"banc":[0,0,0,0,0,0,0],"compo":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"selected":[]}]');
            $match->setComposition($compo);
        //     dump($compo);
            
            $entityManager->persist($match);
            $entityManager->flush();

            // $response = new Response();
        //     $response->setContent(json_encode($compo));
            return new Response('success');
        // }

    }
}
