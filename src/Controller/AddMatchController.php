<?php

namespace App\Controller;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;

class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function index(Request $request)
    {

        $match=new Match();
        $form = $this->createForm(AddMatchFormType::class, $match);



        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
    
            // return $this->redirectToRoute('task_success');
        }




        return $this->render('player_form/index.html.twig', [
            'controller_name' => 'AddMatchController',
            'form' => $form->createView(),
        ]);
    }

        
}
