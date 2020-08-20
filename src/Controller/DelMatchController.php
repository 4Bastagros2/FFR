<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelMatchController extends AbstractController
{
    /**
     * @Route("/del/match/{id_match}", name="del_match")
     */
    public function index(MatchRepository $matchRep,$id_match)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $match=$matchRep->find($id_match);
        $entityManager->remove($match);
        $entityManager->flush();

        //redirection vers lacceuil a voir plus tard ou on va plus tard 
        
        return $this->redirectToRoute('team_screen');

       
    }
}
