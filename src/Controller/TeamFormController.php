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
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted() && $form->isValid()) {
            

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form['picture']->getData();
            // $task1 = $form->get('picture')->getData();

            // $player->addIsPost($form->get('is_post')->getViewData());
            
    
            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = "player".$id_player;
                $safeFilename = "team";
                $newFilename = $safeFilename.'-'.uniqid().'.'.$task->guessExtension();

                try {
                    $task->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $team->setPicture($newFilename);
            } else {
                $team->setPicture("default_avatar.png");
            }

                            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
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
