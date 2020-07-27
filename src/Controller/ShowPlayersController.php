<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowPlayersController extends AbstractController
{
    /**
     * @Route("/show/players", name="show_players")
     */
    public function index()
    {
        return $this->render('show_players/index.html.twig', [
            'controller_name' => 'ShowPlayersController',
        ]);
    }
}
