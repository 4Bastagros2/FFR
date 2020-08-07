<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerFormType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class PlayerFormController extends AbstractController
{
    /**
     * @Route("/player/form/{id}", name="player_form", defaults={"id"=-1})
     */
    public function index(PlayerRepository $PlayerRepo, Request $request, $id, SluggerInterface $slugger, FlashyNotifier $flashy)
    {

        $flashy->success('Event created!', 'http://your-awesome-link.com');

        if($id == -1)
        {
            $player = new Player();
        } else {
            $player = $PlayerRepo->find($id);
        }
        // ...


        // $form = $this->createForm(PlayerFormType::class, $playerForm);
        $form = $this->createForm(PlayerFormType::class, $player);



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
                $safeFilename = "player".$id;
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


            // return $this->redirectToRoute('task_success');
        


        return $this->render('player_form/index.html.twig', [
            'controller_name' => 'PlayerFormController',
            'form' => $form->createView(),
        ]);
    }




    
}
