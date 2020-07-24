<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TeamScreenController extends AbstractController
{
    /**
     * @Route("/team/screen", name="team_screen")
     */

    
    public function index()
    {
        $id = 0;
        
        dump($teams);

        $teams = $this->getDoctrine()
            ->getRepository(Team::class)
            ->find($id);

        

    
        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            'team_name' => $teams->getUsers()[0]->getFinances()->getName()
        ]);
    }
}
