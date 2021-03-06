<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier =$session->get('panier',[]);
        $panierFull = [];
        $total = 0;
        foreach($panier as $id => $quantity){
            $produit = $produitRepository->find($id);
            $panierFull[] = [
                'produit' =>$produit,
                'quantity' => $quantity
            ];
            $total += $produit->getPrix() * $quantity;
        }
        
        // foreach ($panierFull as $item) {
        //     $totalItem = $item['produit']->getPrix() * $item['quantity'];
        //     $total += $totalItem;
        // }
        return $this->render('panier/index.html.twig', [
            'items' => $panierFull,
            'total' => $total
        ]);
    }
    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, SessionInterface $session): Response
    {
        
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        
        $session->set('panier',$panier);
        return $this->redirectToRoute("app_panier");

    }
    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])) {
            unset($panier[$id]);

        }

        $session->set('panier', $panier);
        return $this->redirectToRoute("app_panier");

    }
    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id, SessionInterface $session): Response
    {
        
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            if($panier[$id]> 1){
                $panier[$id]--;
            }
           
        }else{
           unset($panier[$id]);
        }
        
        $session->set('panier',$panier);
        return $this->redirectToRoute("app_panier");

    }
    
}
