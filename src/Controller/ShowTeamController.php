<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;

class ShowTeamController extends AbstractController
{
    /**
     * @Route("/show/team", name="show_team")
     */
    public function index(TeamRepository $team, UserRepository $user)
    {   


        //a voir une foi que la conexion est faite
        // $userConnect = $this->getUser();
        // dump($userConnect);
        $team=$user->find(3)->getCoaches();
        
        return $this->render('show_team/index.html.twig', [
            'team'=>$team
        ]);
    }
}
