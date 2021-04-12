<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            // commencer à envoyer le mail

            $message = (new \Swift_Message('Demande de contact'))
            ->setFrom($contact->getEmail())
            ->setTo('monsite@re.fr')
            ->setBody(
                $this->renderView('emails\contact.html.twig', ['contact'=>$contact]),
                'text/html'
            );
            $mailer->send($message);

            $this->addFlash('contact_success', 'Le message a bien été envoyé');
        }
        

         return $this->render('contact/index.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}
