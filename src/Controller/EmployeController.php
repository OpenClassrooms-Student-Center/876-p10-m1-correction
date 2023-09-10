<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EmployeRepository;
use App\Form\EmployeType;
use Doctrine\ORM\EntityManagerInterface;

class EmployeController extends AbstractController
{
    public function __construct(
        private EmployeRepository $employeRepository,
        private EntityManagerInterface $entityManager,
    )
    {

    }

    #[Route('/employes', name: 'app_employes')]
    public function employes(): Response
    {
        $employes = $this->employeRepository->findAll();
        
        return $this->render('employe/liste.html.twig', [
            'employes' => $employes,
        ]);
    }

    #[Route('/employes/{id}', name: 'app_employe')]
    public function employe($id): Response
    {
        $employe = $this->employeRepository->find($id);

        if(!$employe) {
            return $this->redirectToRoute('app_employes');
        }
        
        return $this->render('employe/employe.html.twig', [
            'employe' => $employe,
        ]);
    }

    #[Route('/employes/{id}/supprimer', name: 'app_employe_delete')]
    public function supprimerEmploye($id): Response
    {
        $employe = $this->employeRepository->find($id);

        if(!$employe) {
            return $this->redirectToRoute('app_employes');
        }

        $this->entityManager->remove($employe);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('app_employes');
    }

    #[Route('/employes/{id}/editer', name: 'app_employe_edit')]
    public function editerEmploye($id, Request $request): Response
    {
        $employe = $this->employeRepository->find($id);

        if(!$employe) {
            return $this->redirectToRoute('app_employes');
        }

        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('app_employes');
        }

        return $this->render('employe/employe.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }
}
