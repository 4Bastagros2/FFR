<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\FormAddTeamType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamScreenController extends AbstractController
{
    /**
     * @Route("/team/screen", name="team_screen")
     */

    
    public function index(Request $request, TeamRepository $teamRepo, TeamRepository $team, UserRepository $user)
    {
        $id = 0;
        
        $team = new Team();

        $form = $this->createForm(FormAddTeamType::class, $team);

        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            $team->addUser($this->getUser());
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();


    
            // return $this->redirectToRoute('task_success');

        }

        $teams = $teamRepo->findAll();
        // dump($teams);

        $userConnect = $this->getUser();
        $team = $user->find($userConnect)->getCoaches();

    
        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            'teams' => $teams,
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }
}
