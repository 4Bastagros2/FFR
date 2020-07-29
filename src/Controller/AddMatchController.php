<?php

namespace App\Controller;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use App\Repository\UserRepository;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function index(Request $request,UserRepository $user)
    {
        $userConnect = $this->getUser();
           
        $id_user = $user->find($userConnect)->getId();
        
        
        $match=new Match();
        $form = $this->createForm(AddMatchFormType::class, $match,[
            'id_user'=>$id_user,
        ]);



        $form->handleRequest($request);
       
        if ($form->isSubmitted()) {
           
            $task=$form->get('domicile');
           
            $data=$task->getViewData();
            
            
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
        ]);
    }

        
}
