<?php

namespace App\Controller;
use App\Entity\Voiture;
use App\Form\VoitureFiltreType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/front')]
class FrontOfficeController extends AbstractController
{

    #[Route('/annonces', name: 'app_front_annonces')]
    public function frontAnnonceList(VoitureRepository $voitureRepository , Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureFiltreType::class, $voiture);
        $form->handleRequest($request);
if($form->isSubmitted()){
//  dd($voiture);die;
    $voitures=$voitureRepository->searchVoiture($voiture);
    return $this->render('front/front_annonces.html.twig', [
        'voitures' => $voitures ,
        'form' => $form ,
    ]);

}


        return $this->render('front/front_annonces.html.twig', [
            'voitures' => $voitureRepository->findAll(),
            'form' => $form ,
        ]);
    }

}