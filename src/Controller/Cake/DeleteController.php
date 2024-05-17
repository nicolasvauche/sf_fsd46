<?php

namespace App\Controller\Cake;

use App\Entity\Cake;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DeleteController extends AbstractController
{
    #[Route('/gateau/supprimer/{id}', name: 'app_cake_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          Cake                   $cake): Response
    {
        if($cake->getImage()) {
            $fileUploaderService->remove('cake', $cake->getImage());
        }

        $entityManager->remove($cake);
        $entityManager->flush();

        $this->addFlash('success', "Le gâteau {$cake->getName()} a bien été supprimé !");

        return $this->redirectToRoute('app_cake_default');
    }
}
