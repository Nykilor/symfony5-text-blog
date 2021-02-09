<?php

namespace App\Controller;

use App\Entity\TextEntry;
use App\Form\TextEntryCreateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 */
class TextEntryController extends AbstractController
{

    /**
     * @Route("/text/entry", name="text_entry")
     */
    public function create(Request $request): Response
    {
        $text_entry = new TextEntry();
        $form = $this->createForm(TextEntryCreateFormType::class, $text_entry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $text_entry->setCreationDate(new \DateTime());
            $text_entry->setUser($this->getUser());
            $entityManager->persist($text_entry);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('current_user_profile');
        }

        return $this->render('text_entry/create.html.twig', [
            'controller_name' => 'TextEntryController',
            'createForm' => $form->createView()
        ]);
    }
}
