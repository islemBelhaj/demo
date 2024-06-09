<?php

namespace App\service;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class ReservationService
{
    public EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;


    }

    public function gettAll(): array
    {
        $reservations = $this->em->getRepository(Reservation::class)->findAll();
        return $reservations;
    }

    public function add($dateDebut, $dateFin, $voiture ,$user ,$createdBy)
    {


            $reservation = new Reservation();
            $now = new \DateTimeImmutable();
            $now->format('Y-m-d');
            $reservation->setDateDebut($dateDebut);
            $reservation->setDateFin($dateFin);
            $reservation->setIdVoiture($voiture);
            $reservation->setIdUtilisateur($user);
            $reservation->setStatut(1);
            $reservation->setCreatedAt($now);
            $reservation->setCreatedBy($createdBy);


            $this->em->persist($reservation);
            $this->em->flush();

        }

    }
