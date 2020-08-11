<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerFormType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ShowPlayersController extends AbstractController
{
    /**
     * @Route("/show/players/{id_team}", name="show_players")
     */
    public function index(Request $request, TeamRepository $teamrepo, PlayerRepository $playerrepo, $id_team)
    {
        $thisTeam = $teamrepo->findById($id_team)[0];
        $thisPlayers = $thisTeam->getPlayers();

        $form = $this->createForm(PlayerFormType::class);

        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted() && $form->isValid()) {
            $player = new Player();
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form['picture']->getData();
            // $task1 = $form->get('picture')->getData();

            // $player->addIsPost($form->get('is_post')->getViewData());
            
    
            if ($task) {



                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = "player".$id_player;
                $safeFilename = "player";
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
                $player->setPicture($newFilename);


                            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();
            }

            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('player_form'));
        }




        return $this->render('show_players/index.html.twig', [
            'controller_name' => 'ShowPlayersController',
            "players" => $thisPlayers,
            "team" => $thisTeam,
            "idteam" => $id_team,
            'form' => $form->createView()
        ]);
    }
}
