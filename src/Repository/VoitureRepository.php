<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    //    /**
    //     * @return Voiture[] Returns an array of Voiture objects
    //     */
    public function searchVoiture(Voiture $voiture)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.couleur = :v_couleur')
            ->andWhere('v.id_Model = :v_model')
            ->setParameter('v_couleur', $voiture->getCouleur())
            ->setParameter('v_model', $voiture->getIdModel())
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    public function getListeModeles(int $marqueId )
    {
        return $this->createQueryBuilder('v')
            ->select('m.id, m.libelle')
            ->join('v.modele', 'm')
            ->where('v.marque = :marque')
            ->setParameter('marque', $marqueId)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }
}
