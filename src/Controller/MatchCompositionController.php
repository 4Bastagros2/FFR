<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MatchCompositionController extends AbstractController
{
    /**
     * @Route("/match/composition", name="match_composition")
     */
    public function index()
    {
        return $this->render('match_composition/index.html.twig', [
            'controller_name' => 'MatchCompositionController',
        ]);
    }
}
