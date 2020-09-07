<?php

namespace App\Controller;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\WebLink\Link;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function index()
    {
        $username = $this->getUser()->getUsername();
        $token = (new builder())
        ->withClaim('mercure', ['suscribe' => [sprintf("/%s", $username)]])
        ->getToken(
            new Sha256(),
            new Key($this->getParameter('mercure_secret_key')),
            )
        ;
        $response =  $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
        ]);

        $response->headers->setCookie(
            new Cookie(
                'mercureAuthorization',
                $token,
                (new \Datetime())
                ->add(new \DateInterval('PT2H'))
                ->withValue($token)
                ->withPath('/.well-known/mercure')
                ->withSecure(true)
                ->withHttpOnly(true)
                ->withSameSite('strict')
            )
            );

            return $response;
    }
}
