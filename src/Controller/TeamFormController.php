<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\FormAddTeamType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TeamFormController extends AbstractController
{
    /**
     * @Route("/team/form", name="team_form")
     */
    public function index(Request $request,$id)
    {

        $team = new Team();
        $form = $this->createForm(FormAddTeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form['picture']->getData();

            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = "team";
                $newFilename = $safeFilename.'-'.uniqid().'.'.$task->guessExtension();

                try {
                    $task->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $team->setPicture($newFilename);
            } else {
                $team->setPicture("default_avatar.png");
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();
        }
        
        return $this->render('team_form/index.html.twig', [
            'controller_name' => 'TeamFormController',
            'form' => $form->createView()
        ]);
    }
}
