<?php

namespace App\Controller;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;

class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function index(Request $request,ClubRepository $club)
    {

        $match=new Match();
        $form = $this->createForm(AddMatchFormType::class, $match);



        $form->handleRequest($request);
       
        if ($form->isSubmitted()) {
           
            $task=$form->get('domicile');
           
            $data=$task->getViewData();
            dump($club->getName());
            if($data==1){
                
            }
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
