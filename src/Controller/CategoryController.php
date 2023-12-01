<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CategoryController extends AbstractController
{
    #[Route('/category', name: "category_index")]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }
    #[Route('/category/{categoryName}', name: "category_show")]
    public function show(string $categoryName, EntityManagerInterface $entityManager): Response
    {
        $category = $entityManager->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException('La catégorie n\'existe pas');
        }
        $programs = $entityManager->getRepository(Program::class)->findBy(
            ['category' => $category],
            ['id' => 'DESC'],
            3
        );
        return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $programs]);
    }
}