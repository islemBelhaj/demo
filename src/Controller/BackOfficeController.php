<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
#[Route('/back')]
class BackOfficeController extends AbstractController
{

    #[Route('/redirection', name: 'app_back_redirection')]
    public function index(){
        $roles = $this->getUser()->getRoles();
        if (in_array("ROLE_ADMIN", $roles)) {
            return  $this->redirectToRoute('admin_voiture_index') ;
        }
        elseif (in_array("ROLE_LOCATAIRE", $roles)) {
            return   $this->redirectToRoute('locataire_liste_voiture') ;
        }
    }
}