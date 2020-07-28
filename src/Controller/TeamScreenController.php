<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TeamScreenController extends AbstractController
{
    /**
     * @Route("/team/screen", name="team_screen")
     */

    
    public function index(TeamRepository $teamRepo)
    {
        $id = 0;
        
        
        $teams = $teamRepo->findAll();
        // dump($teams);

        

    
        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            'teams' => $teams
        ]);
    }
}
