<?php

namespace App\Controller\Cake;

use App\Entity\Cake;
use App\Form\CakeType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditController extends AbstractController
{
    #[Route('/gateau/modifier/{slug}', name: 'app_cake_edit')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger,
                          Cake                   $cake): Response
    {
        $form = $this->createForm(CakeType::class, $cake);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $cakeImage = $form->get('image')->getData();
            if($cakeImage) {
                $fileUploaderService->remove('cake', $cake->getImage());
                $filename = $fileUploaderService->upload($cakeImage, 'cake', strtolower($slugger->slug($cake->getName())));
                $cake->setImage($filename);
            }

            $entityManager->persist($cake);
            $entityManager->flush();

            $this->addFlash('success', "Le gâteau {$cake->getName()} a bien été modifié !");

            return $this->redirectToRoute('app_cake_default');
        }

        return $this->render('cake/edit/index.html.twig', [
            'cake' => $cake,
            'form' => $form->createView(),
        ]);
    }
}
