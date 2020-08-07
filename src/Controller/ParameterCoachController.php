<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Team;
use App\Form\CoachFormType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParameterCoachController extends AbstractController
{
    /**
     * @Route("/parameter/coach", name="parameter_coach")
     */

    //  recuperer email, verifie que c est un un doublon
    // verifie l existence du user
    // chercher l id du detenteur du compte 
    // regarder l id du connecter et l ajouter 
    // ajouter l id_team du connecter avec l id du mail ci dessus 


    public function index(UserReposintory $UserRepo, TeamRepository $teams, Request $request, SluggerInterface $slugger)
    {
        $mail = $UserRepo->findOneBy(array($email=>"email"));
        dump($mail);
        
        

        return $this->render('parameter_coach/index.html.twig', [
            'controller_name' => 'ParameterCoachController',
            // 'form' => $form->createView(),
        ]);
    }
}
