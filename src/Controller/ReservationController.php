<?php

namespace App\Controller;


use App\Entity\Reservation;
use App\service\ReservationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(ReservationService $reservationService): Response
    {
        $reservations=$reservationService->gettAll();
        return $this->render('reservation/index.html.twig', [

            'reservations' => $reservations,
        ]);
    }
#[Route('/reservation/{id}, name: app_reservation')]

    public function editStatut( int $id, EntityManagerInterface $em ): Response
    {
        $reservation = $em->getRepository(Reservation::class)->find($id);
        $request = Request::createFromGlobals();

        if (!$reservation) {
            throw $this->createNotFoundException('No reservation found for id ' . $id);
        }

        if ($request->query->get('idReservationAcc')) {
            $reservation->setStatut(2);
        } elseif ($request->query->get('idReservationRef')) {
            $reservation->setStatut(0);
        } else {
            throw $this->createNotFoundException('Invalid action');
        }

        $em->flush();

        return $this->redirectToRoute('app_reservation');
    }
#[Route('/reservation, name: app_reservation')]
    public function list(EntityManagerInterface $em): Response
    {
        $reservations = $em->getRepository(Reservation::class)->findAll();

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
