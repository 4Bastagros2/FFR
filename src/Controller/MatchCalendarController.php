<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCalendarController extends AbstractController
{
    /**
     * @Route("/match/calendar/{id_team}", name="match_calendar")
     */
    public function index(MatchRepository $match,TeamRepository $team,$id_team, UserRepository $user, ClubRepository $clubRepo)
    {
        $match=$team->find($id_team)->getPlayMatches();
        $match_id=$team->find($id_team);

       

        $userConnect = $this->getUser();
        $userClub=$user->find($userConnect)->getFinances()->getId();
        $club=$clubRepo->find($userClub)->getName();
        $count=$match->count($club);
        
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
                $joueur[$i] = $team->find($id_team)->getPlayers()[$i];
                $stat[$i][0]=$joueur[$i]->getLestName();
                $stat[$i][1]=$joueur[$i]->getFirstName();
                $stat[$i][2]=$joueur[$i]->getEssais()*5+$joueur[$i]->getTransformations()*2+$joueur[$i]->getDrops()*3+$joueur[$i]->getPenalites()*3;
                
                $i++;
                if($i==5){
                    $z=0;
                }
            }else{
                $z=0;
            }  
        }
        arsort($stat);
        


        
        

        
        return $this->render('match_calendar/index.html.twig', [
            'match'=>$match,
            'match_id'=>$match_id,
            'resultat'=>$resultat,
            'meilleur_buteur'=>$stat,
            'id_team' => $id_team,
        ]);
    }
}
