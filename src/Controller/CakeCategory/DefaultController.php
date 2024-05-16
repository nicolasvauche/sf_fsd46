<?php

namespace App\Controller\CakeCategory;

use App\Entity\CakeCategory;
use App\Form\CakeCategoryType;
use App\Repository\CakeCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/categories-de-gateaux')]
class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_cake_category_default_index', methods: ['GET'])]
    public function index(CakeCategoryRepository $cakeCategoryRepository): Response
    {
        return $this->render('cake_category/default/index.html.twig', [
            'cake_categories' => $cakeCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cake_category_default_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cakeCategory = new CakeCategory();
        $form = $this->createForm(CakeCategoryType::class, $cakeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cakeCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_cake_category_default_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cake_category/default/new.html.twig', [
            'cake_category' => $cakeCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cake_category_default_show', methods: ['GET'])]
    public function show(CakeCategory $cakeCategory): Response
    {
        return $this->render('cake_category/default/show.html.twig', [
            'cake_category' => $cakeCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cake_category_default_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CakeCategory $cakeCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CakeCategoryType::class, $cakeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cake_category_default_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cake_category/default/edit.html.twig', [
            'cake_category' => $cakeCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cake_category_default_delete', methods: ['POST'])]
    public function delete(Request $request, CakeCategory $cakeCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cakeCategory->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cakeCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cake_category_default_index', [], Response::HTTP_SEE_OTHER);
    }
}
