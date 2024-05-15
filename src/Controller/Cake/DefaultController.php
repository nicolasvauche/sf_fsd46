<?php

namespace App\Controller\Cake;

use App\Repository\CakeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/cake', name: 'app_cake_default')]
    public function index(CakeRepository $cakeRepository): Response
    {
        $cakes = $cakeRepository->findAll();

        return $this->render('cake/default/index.html.twig', [
            'cakes' => $cakes,
        ]);
    }
}
