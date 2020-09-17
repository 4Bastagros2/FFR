<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Team;
use App\Form\ChatType;
use App\Form\FormAddTeamType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TeamScreenController extends AbstractController
{
    /**
     * @Route("/team/screen", name="team_screen")
     */

    
    public function index(Request $request, TeamRepository $teamRepo, TeamRepository $team, UserRepository $user, FlashyNotifier $flashy)
    {
        $id = 0;
        
        $team = new Team();

        $form = $this->createForm(FormAddTeamType::class, $team);

        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->addFlash('success', 'Ajouté avec succes !');
            $task = $form['picture']->getData();
            $team->addUser($this->getUser());

            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
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
                $team->setPicture("ballon.png");
            }
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('team_screen');
        }

        $teams = $teamRepo->findAll();
        $userConnect = $this->getUser();
        $team = $user->find($userConnect)->getCoaches();



        $chat = new Chat();
                $formchat = $this->createForm(ChatType::class, $chat);
                $formchat->handleRequest($request);

                if ($formchat->isSubmitted() && $formchat->isValid()) {
                    $chat->setAuteur($this->getUser()->getUsername());
                    // $chat->setProjet($projet);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($chat);
                    $entityManager->flush();                     
                }

        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            'teams' => $teams,
            'team' => $team,
            'form' => $form->createView(),
            'chat' => $formchat->createView(),
        ]);
    }
}
