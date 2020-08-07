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
    public function index(UserRepository $UserRepo, TeamRepository $teams, Request $request, SluggerInterface $slugger)
    {
        $id = $this->getUser()->getId();

        $connectedUser = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($id);
        $userTeams = $connectedUser->getCoaches();

        $form = $this->createForm(CoachFormType::class, $userTeams);
        $form->handleRequest($request);

        if($form->isSubmitted()) 
        {
            $data->getViewData();
            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($userTeams);
                $entityManager->flush();
        }

        return $this->render('parameter_coach/index.html.twig', [
            'controller_name' => 'ParameterCoachController',
            // 'form' => $form->createView(),
        ]);
    }
}
