<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerFormType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlayerFormController extends AbstractController
{
    /**
     * @Route("/player/form/{id}", name="player_form", defaults={"id"=-1})
     */
    public function index(PlayerRepository $PlayerRepo, Request $request, $id)
    {

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
        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // $player->addIsPost($form->get('is_post')->getViewData());
            
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();
    
            // return $this->redirectToRoute('task_success');
        }




        return $this->render('player_form/index.html.twig', [
            'controller_name' => 'PlayerFormController',
            'form' => $form->createView(),
        ]);
    }




    
}
