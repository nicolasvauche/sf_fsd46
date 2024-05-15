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

class AddController extends AbstractController
{
    #[Route('/gateau/nouveau', name: 'app_cake_add')]
    public function index(Request                $request,
                          EntityManagerInterface $entityManager,
                          FileUploaderService    $fileUploaderService,
                          SluggerInterface       $slugger): Response
    {
        $cake = new Cake();
        $form = $this->createForm(CakeType::class, $cake);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $cakeImage = $form->get('image')->getData();
            if($cakeImage) {
                $filename = $fileUploaderService->upload($cakeImage, 'cake', strtolower($slugger->slug($cake->getName())));
                $cake->setImage($filename);
            }

            $cake->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($cake);
            $entityManager->flush();

            return $this->redirectToRoute('app_cake_default');
        }

        return $this->render('cake/add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
