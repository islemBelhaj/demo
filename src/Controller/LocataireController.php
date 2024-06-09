<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use App\service\ReservationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/locataire')]
class LocataireController extends AbstractController
{
    #[Route('/liste/voitures', name: 'locataire_liste_voiture')]
    public function index( VoitureRepository $voitureRepository): Response
    {
        return $this->render('back/locataire/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    #[Route('/reservation/{id}', name: 'locataire_create_reservation')]
    public function createReservation( Request $request , SessionInterface $session , ReservationService $reservationService,EntityManagerInterface $em,VoitureRepository $vt,$id): Response
    {


        if ($request->isMethod('POST')) {
            $voiture = $vt->find($id);

            $dateDebutStr = $request->request->get("dateDebut");
            $dateFinStr = $request->request->get("dateFin");

            $reservation = new Reservation();
            $reservation->setStatut(0);
            $reservation->setCreatedBy($this->getUser());
            $reservation->setCreatedAt(new \DateTimeImmutable());
            $reservation->setDateDebut(new \DateTime($dateDebutStr));
            $reservation->setDateFin(new \DateTime($dateFinStr));
            $reservation->setIdUtilisateur($this->getUser());
            $reservation->setIdVoiture($voiture) ;

            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('locataire_liste_voiture');
        }

        return $this->render('back/locataire/reservation.html.twig', []);

    }
}