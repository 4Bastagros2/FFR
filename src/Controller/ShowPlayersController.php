<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowPlayersController extends AbstractController
{
    /**
     * @Route("/show/players/{id_team}/", name="show_players")
     */
    public function index(TeamRepository $teamrepo, $id_team)
    {
        $thisTeam = $teamrepo->findById($id_team)[0];
        $thisPlayers = $thisTeam->getPlayers();


        return $this->render('show_players/index.html.twig', [
            'controller_name' => 'ShowPlayersController',
            "players" => $thisPlayers,
            "team" => $thisTeam,
        ]);
    }
}
