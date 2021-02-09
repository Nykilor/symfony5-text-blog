<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $last_created_users = $em->getRepository(User::class)->getLastCreatedUsers(20);

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'users' => $last_created_users
        ]);
    }
}
