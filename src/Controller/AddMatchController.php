<?php

namespace App\Controller;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function index(Request $request,UserRepository $user)
    {

        $match=new Match();
        $form = $this->createForm(AddMatchFormType::class, $match);



        $form->handleRequest($request);
       
        if ($form->isSubmitted()) {
           
            $task=$form->get('domicile');
           
            $data=$task->getViewData();
            $userConnect = $this->getUser();
           
            $team = $user->find($userConnect)->getCoaches();
            dump($team);
            if($data==1){
                $localTeam= $user->find($userConnect)->getFinances()->getName();
                $visitorTeam=$form->get("local_team")->getViewData();
            }else{
                $localTeam=$form->get("local_team")->getViewData();
                $visitorTeam=$user->find($userConnect)->getFinances()->getName();
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
    
            // return $this->redirectToRoute('task_success');
        }




        return $this->render('player_form/index.html.twig', [
            'controller_name' => 'AddMatchController',
            'form' => $form->createView(),
            "user"=>$userConnect->getId()
        ]);
    }

        
}
