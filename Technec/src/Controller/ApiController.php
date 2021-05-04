<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

     /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar, Request $request): Response
    {
            // On recupère les données
            $datas = json_decode($request->getContent());
            if(
                isset($datas->title) && !empty($datas->title) &&
                isset($datas->start) && !empty($datas->start) &&
                isset($datas->description) && !empty($datas->description) &&
                isset($datas->backgroundColor) && !empty($datas->backgroundColor) &&
                isset($datas->borderColor) && !empty($datas->borderColor) &&
                isset($datas->textColor) && !empty($datas->textColor) 

                ){
                    // les données sont complètes
                    // On initialise un code
                    $code = 200;

                    // On vérifie si l'id existe
                    if(!$calendar){
                        // On instancie un rendez-vous
                        $calendar = new Calendar;

                        // On change le code 
                        $code= 201;
                    }

                    //  On hydrate l'objet avec les données
                    $calendar->setTitle($datas->title);
                    $calendar->setDescription($datas->description);
                    $calendar->setStart(new DateTime($datas->start));
                    if($datas->allDay){
                        $calendar->setEnd(new DateTime($datas->start));
                    }else{
                        $calendar->setEnd(new DateTime($datas->end));
                    }
                   
                    $calendar->setAllDay($datas->allDay);
                    $calendar->setBackgroundColor($datas->backgroundColor);
                    $calendar->setBorderColor($datas->borderColor);
                    $calendar->setTextColor($datas->textColor);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($calendar);
                    $em->flush();

                    // On retourne un code
                    return new Response('Ok', $code);
                }else{
                    // les données sont incomplètes
                    return new Response('données incomplètes', 404);
                }


        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
