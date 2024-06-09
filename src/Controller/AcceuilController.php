<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\UtilisateurRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class AcceuilController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]

    public function index( VoitureRepository $voitureRepository): Response
    {
        return $this->render('acceuil/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }
//    #[Route('/acceuil/details{id}', name: 'acceuil_show', methods: ['GET'])]
//    public function show(Voiture $voiture): Response
//    {
//        return $this->render('acceuil/details.html.twig', [
//            'voiture' => $voiture,
//        ]);
//    }

    #[Route('/verify/email', name: 'verify_email')]
    public function checkEmail(Request $request, UtilisateurRepository $repository): JsonResponse
    {

        $email = $request->getPayload()->get('email');
        $utilisateur = $repository->findOneBy(array('email' => $email)) ;

        if ($utilisateur) {
            return new JsonResponse(['res' => true]);
        } else {
            return new JsonResponse(['res' => false]);
        }
    }
}
