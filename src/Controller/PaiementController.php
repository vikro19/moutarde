<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
           
        ]);
    }
     /**
     * @Route("/success", name="app_success")
     */
    public function success(): Response
    {
        return $this->render('paiement/success.html.twig', [
            
        ]);
    }
     /**
     * @Route("/erreur", name="app_erreur")
     */
    public function erreur(): Response
    {
        return $this->render('paiement/erreur.html.twig', [
           
        ]);
    }
    /**
     * @Route("/create-checkout-session", name="app_paiement")
     */
    public function checkout(): Response
    {
        \Stripe\Stripe::setApiKey('sk_test_51IaiJiCFA8tFMNMtQZaQ8lPBgIJzyLFL8ikLe5uKh9zxe5N5MFYnWuJ48TTIxntmrQ14qHXTDVYM4cPfciwU1W4600WnrOgzOq');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
                    # These placeholder URLs will be replaced in a following step.
                    'success_url' => $this->generateUrl('app_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
                    'cancel_url' => $this->generateUrl('app_erreur', [], UrlGeneratorInterface::ABSOLUTE_URL),
                ]);
          return new JsonResponse(['id'=>$session->id]);
    }
}
