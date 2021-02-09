<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/{username}", name="user_profile")
     * @ParamConverter("user", class="App\Entity\User")
     */
    public function index(User $user): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/me", name="current_user_profile")
     */
    public function me(Request $request)
    {
        $user = $this->getUser();

        if(is_null($user)) {
            return $this->redirectToRoute('app_login');
        } else {
            return $this->render('user_profile/index.html.twig', [
                'controller_name' => 'UserProfileController',
                'user' => $user
            ]);
        }
    }
}
