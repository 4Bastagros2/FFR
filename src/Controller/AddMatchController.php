<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match", name="add_match")
     */
    public function index()
    {
        return $this->render('add_match/index.html.twig', [
            'controller_name' => 'AddMatchController',
        ]);
    }
}
