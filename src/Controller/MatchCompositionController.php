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
     * @Route("/match/composition/{id_match}/{id_composition}", name="match_composition", defaults={"id_composition"=0})
     */
    public function index(MatchRepository $matchRep, $id_match, $id_composition)
    {
        $date=$matchRep->find($id_match)->getDate()->format('Y-m-d H:i:s');
        $today=date('Y-m-d H:i:s');
        ;
        dump($date);
        dump($today);
        if($today>$date){
            $return = $this->redirectToRoute('stat_match',["id"=>$id_match]);
        }else{

        
        


        $match=$matchRep->find($id_match);

        // if(date("Y-m-d H:i:s") > $match->getDate())
        //     return $this->redirect($this->generateUrl('stats_match'));


        $compo = $match->getComposition();

        // dump($compo);

        $team = $match->getTeams()[0];

        $id_team = $team->getId();

        $players = $team->getPlayers();

        // $bench = [];

        // foreach ($players as $player)
        // {
        //         if(!in_array($player->getId(), $compo))
        //         {
        //             // dump('player in bench'.$player->getId());
        //             $bench[] = $player;
        //         }
        // }

        // dump($players);
        // dump($bench);
        // dump(json_encode($bench));
        
        
        // 'bench' => $bench,
        $return = $this->render('match_composition/index.html.twig', [
            'controller_name' => 'MatchCompositionController',
            'id_match' => $id_match,
            'players' => $players,
            'composition' => json_encode($compo),
            'idteam' => $id_team,
            'idcomposition' => $id_composition,
        ]);
    }
    return $return;
}


    /**
     * @Route("/match/composition/update/{id_match}", name="match_composition_update")
     */
    public function update(Request $request, MatchRepository $matchRep, $id_match) {
        // if ($request->isXmlHttpRequest() ||  $request->request->get('composition') == 1)
        // {

            
        //     $entityManager = $this->getDoctrine()->getManager();
            
        //     dump($request);
        //     $match=$matchRep->find($id_match);
        //     // $compo = json_decode($request->request->get('composition'));
        //     $compo = $request->request->get('composition');
        //     dump($composition);
        //     // $compo = json_decode('[{"banc":[36,32],"compo":[0,0,0,0,17,37,0,32,0,0,0,0,0,0,0,0],"selected":[1]},{"banc":[0,0,0,0,0,0,0],"compo":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"selected":[]},{"banc":[0,0,0,0,0,0,0],"compo":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"selected":[]}]');
        //     // $match->setComposition($compo);
        //     dump($compo);
            
        //     $entityManager->persist($match);
        //     $entityManager->flush();

            $response = new Response();
        //     $response->setContent(json_encode($compo));
            return $response;
        // }

    }
}
