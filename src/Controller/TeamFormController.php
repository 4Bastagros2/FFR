<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\FormAddTeamType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamFormController extends AbstractController
{
    /**
     * @Route("/team/form/{id_team}", name="team_form")
     */
    public function index(Team $team, Request $request, EntityManagerInterface $manager)
    {
        dump($team);

        // $form = $this->createForm(FormAddTeamType::class, $team);

        // $form->handleRequest($request);
        // // if ($form->isSubmitted() && $form->isValid()) {
        // if ($form->isSubmitted()) {
        //     // $form->getData() holds the submitted values
        //     // but, the original `$task` variable has also been updated
        //     $task = $form->getData();

        //     $team->addUser($this->getUser());
    
        //     // ... perform some action, such as saving the task to the database
        //     // for example, if Task is a Doctrine entity, save it!
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($team);
        //     $entityManager->flush();


    
            // return $this->redirectToRoute('task_success');

        // }

        return $this->render('team_form/index.html.twig', [
            'controller_name' => 'TeamFormController',
            'form' => $form->createView()
        ]);
    }
}
