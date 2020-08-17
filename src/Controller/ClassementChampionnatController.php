<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassementChampionnatController extends AbstractController
{
    /**
     * @Route("/classement/championnat", name="classement_championnat")
     */
    public function index()
    {
        return $this->render('classement_championnat/index.html.twig', [
            'controller_name' => 'ClassementChampionnatController',
        ]);
    }
}
