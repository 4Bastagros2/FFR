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
    public function index(MatchRepository $match, MatchTypeRepository $type,TeamRepository $team,$id_team, UserRepository $user, ClubRepository $clubRepo)
    {
        $match=$team->find($id_team)->getPlayMatches();
        $match_id=$team->find($id_team);

       

        $userConnect = $this->getUser();
        $userClub=$user->find($userConnect)->getFinances()->getId();
        $club=$clubRepo->find($userClub)->getName();
        $count=$match->count($club);
        dump($count);
        $y=-1;
        for($i=$count;$i>$count-5;$i--){
            $y++;
            dump($y);
            dump($team->find($id_team)->getPlayMatches()[$y]->getId());
            $local=$team->find($id_team)->getPlayMatches()[$y]->getLocalTeam();
            if($club==$local){
                dump($club);
                dump($local);
                dump("3");
                $score=$team->find($id_team)->getPlayMatches()[$y]->getStats();
                $score=$score[0]['score'];
                $score1=$score{0};
                $score2=$score{2};
                dump($score1);
                dump($score2);
                if($score1>$score2){
                    dump("4");
                    $resultat[$i]=1;
                }else if($score1<$score2){
                    dump("5");
                    $resultat[$i]=2;
                }else{
                    dump('6');
                    $resultat[$i]=0;
                }
                
            }else{
                $score=$team->find($id_team)->getPlayMatches()[$y]->getStats();
                dump("7");
                if(isset($score[0]["score"])){
                    dump("8");
                    $score=$score[0]["score"];
                    $score1=$score{0};
                    $score2=$score{2};
                    if($score2>$score1){
                        dump('9');
                        $resultat[$i]=1;
    
                    }else if($score2<$score1){
                        dump("10");
                        $resultat[$i]=2;
                    }else{
                        dump('11');
                        $resultat[$i]=0;
                    }
                }
            
                
            }
            
        }
        
        

        
        return $this->render('match_calendar/index.html.twig', [
            'match'=>$match,
            'match_id'=>$match_id,
            'resultat'=>$resultat
        ]);
    }
}
