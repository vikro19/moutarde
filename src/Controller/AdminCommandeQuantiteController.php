<?php

namespace App\Controller;

use App\Entity\CommandeQuantite;
use App\Form\CommandeQuantiteType;
use App\Repository\CommandeQuantiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/quantite")
 */
class AdminCommandeQuantiteController extends AbstractController
{
    /**
     * @Route("/", name="admin_commande_quantite_index", methods={"GET"})
     */
    public function index(CommandeQuantiteRepository $commandeQuantiteRepository): Response
    {
        return $this->render('admin_commande_quantite/index.html.twig', [
            'commande_quantites' => $commandeQuantiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_commande_quantite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeQuantite = new CommandeQuantite();
        $form = $this->createForm(CommandeQuantiteType::class, $commandeQuantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeQuantite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_quantite_index');
        }

        return $this->render('admin_commande_quantite/new.html.twig', [
            'commande_quantite' => $commandeQuantite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_commande_quantite_show", methods={"GET"})
     */
    public function show(CommandeQuantite $commandeQuantite): Response
    {
        return $this->render('admin_commande_quantite/show.html.twig', [
            'commande_quantite' => $commandeQuantite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_commande_quantite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeQuantite $commandeQuantite): Response
    {
        $form = $this->createForm(CommandeQuantiteType::class, $commandeQuantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_commande_quantite_index');
        }

        return $this->render('admin_commande_quantite/edit.html.twig', [
            'commande_quantite' => $commandeQuantite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_commande_quantite_delete", methods={"POST"})
     */
    public function delete(Request $request, CommandeQuantite $commandeQuantite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeQuantite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeQuantite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande_quantite_index');
    }
}
