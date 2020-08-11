<?php

namespace App\Controller;
use DateTime;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use App\Repository\ClubRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCalendarController extends AbstractController
{
    /**
     * @Route("/match/calendar/{id_team}{id_match}", name="match_calendar", defaults={"id_match"=-1})
     */
    public function index(Request $request, MatchRepository $match,TeamRepository $team,$id_team, UserRepository $user, $id_match, ClubRepository $clubRepo)
    {
        $match=$team->find($id_team)->getPlayMatches();

        $match_id=$team->find($id_team);

       $resultat = [];
       $stat = [];

        $userConnect = $this->getUser();
        $userClub=$user->find($userConnect)->getFinances()->getId();
        $club=$clubRepo->find($userClub)->getName();
        $count=$match->count($club);
        
        if($count > 0) {

            $y=-1;
            for($i=$count;$i>$count-5;$i--){
                $y++;
               
                $local=$team->find($id_team)->getPlayMatches()[$y]->getLocalTeam();
                if($club==$local){
                   if(($team->find($id_team)->getPlayMatches()[$y]->getStats()!=NULL) && (isset($score[0]['score']))){
                        $score=$team->find($id_team)->getPlayMatches()[$y]->getStats();
                        $score=$score[0]['score'];
                        $score1=$score{0};
                        $score2=$score{2};
                   
                    
                   
                        if($score1>$score2){
                        
                            $resultat[$i]=1;
                        }else if($score1<$score2){
                        
                            $resultat[$i]=2;
                        }else{
                        
                            $resultat[$i]=0;
                        }
                    }
                }else{
                    $score=$team->find($id_team)->getPlayMatches()[$y]->getStats();
                   
                    if(isset($score[0]["score"])){
                        
                        $score=$score[0]["score"];
                        $score1=$score{0};
                        $score2=$score{2};
                        if($score2>$score1){
                           
                            $resultat[$i]=1;
        
                        }else if($score2<$score1){
                            
                            $resultat[$i]=2;
                        }else{
                            
                            $resultat[$i]=0;
                        }
                    }
                
                    
                }
                
            }
            $z=2;
            $i=0;
            
            while($z!=0){
                if(isset($team->find($id_team)->getPlayers()[$i])){

                    $current_match_id = $team->find($id_team)->getPlayMatches()[$y]->getId();

                    $joueur[$i] = $team->find($id_team)->getPlayers()[$i];
                    $stat[$i][0]=$joueur[$i]->getLestName();
                    $stat[$i][1]=$joueur[$i]->getFirstName();
                    // $stat[$i][2]=$joueur[$i]->getEssais($current_match_id)*5+$joueur[$i]->getTransformations($current_match_id)*2+$joueur[$i]->getDrops($current_match_id)*3+$joueur[$i]->getPenalites($current_match_id)*3;
                    
                    $i++;
                    if($i==5){
                        $z=0;
                    }
                }else{
                    $z=0;
                }  
            }
            arsort($stat);
            
        }

        // form add match

        if($id_match==-1){
            $match= new Match();
        }else{
            $match=$matchRep->find($id_match);
        }

        $id = $this->getUser()->getId();

        $connectedUser = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($id);
        $userTeams = $connectedUser->getCoaches();

        

        $form = $this->createForm(AddMatchFormType::class, $match,[
            'teams' => $userTeams,
            // 'filsdepute' => $userConnect->getUsername()
            // 'userId' => $this->getUser()->getId()
        ]);


        $form->handleRequest($request);
       
        if ($form->isSubmitted()) {
           
            $task=$form->get('domicile');
           
            $data=$task->getViewData();
            
           
          
           
            // if ($form->isSubmitted() && $form->isValid()) {
            // if ($form->isSubmitted()) {
            //     // $form->getData() holds the submitted values
            //     // but, the original `$task` variable has also been updated
                $task = $form->getData();
        
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($match);
                $entityManager->flush();
        
            //     // return $this->redirectToRoute('task_success');
            
            
            
            if($data==1){
                $localTeam= $user->find($connectedUser)->getFinances()->getName();
                $visitorTeam=$form->get("local_team")->getViewData();
            }else{
                $localTeam=$form->get("local_team")->getViewData();
                $visitorTeam=$user->find($connectedUser)->getFinances()->getName();
            }
            
            $match->setLocalTeam($localTeam);
            $match->setVisitorTeam($visitorTeam);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
            
            $match->addTeam( $this->getDoctrine()->getRepository(Team::class)->find($id_team) );
            // ->find($form->get('teams')->getViewData()[0]));
            
           

            $teams->find($id_team)->addPlayMatch($match);
            
           
            
            $entityManager->persist($match);
            $entityManager->flush();
            
            
            //return $this->redirectToRoute('match_calendar',['id_team'=>$user->find($connectedUser)->getFinances()->getId()]);
        

        }

        
        

        
        return $this->render('match_calendar/index.html.twig', [
            'match'=>$match,
            'resultat'=>$resultat,
            'meilleur_buteur'=>$stat,
            'idteam' => $id_team,
            'form' => $form->createView(),
        ]);
    }
}
