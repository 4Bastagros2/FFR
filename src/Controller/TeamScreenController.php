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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TeamScreenController extends AbstractController
{
    /**
     * @Route("/team/screen", name="team_screen")
     */

    
    public function index(Request $request, TeamRepository $teamRepo, TeamRepository $team, UserRepository $user)
    {
         $id = 0;
        // $open_modal = false;

        // if($id_team == -1)
        // {
        //     $team = new Team();
        // } else if($id_team == -2) {
        //     $team = new Team();
        //     $open_modal = true;
        // } else {
        //     $team = $teamRepo->find($id_team);
        //     $open_modal = true;
        // }

        // $thisTeam = $teamrepo->findById($id_team)[0];


        
        $team = new Team();

        // $form = $this->createForm(FormAddTeamType::class, $team);

        // $form->handleRequest($request);
        // // if ($form->isSubmitted() && $form->isValid()) {
        // if ($form->isSubmitted()) {
        //     // $form->getData() holds the submitted values
        //     // but, the original `$task` variable has also been updated
        //     $task = $form->getData();

        //     $team->addUser($this->getUser());

        $form = $this->createForm(FormAddTeamType::class, $team);

        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted() && $form->isValid()) {
            

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            $team->setCategory();
            $team->setPlaySeason();

            $task = $form['picture']->getData();
            $team->addUser($this->getUser());
            
            // $task1 = $form->get('picture')->getData();

            // $team->addIsPost($form->get('is_post')->getViewData());
            
    
            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = "team".$id_team;
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


    
            // return $this->redirectToRoute('task_success');

        }

        $teams = $teamRepo->findAll();
        

        $userConnect = $this->getUser();
        $team = $user->find($userConnect)->getCoaches();
        
    
        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            'teams' => $teams,
            'team' => $team,
            'form' => $form->createView(),
        ]);

        return $this->render('team_screen/index.html.twig', [
            'controller_name' => 'TeamScreenController',
            "team" => $thisTeam,
            "idteam" => $id_team,
            "openmodal" => $open_modal,
            'form' => $form->createView()
        ]);
    }
}
