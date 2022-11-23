<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if(!$category){
            throw $this->createNotFoundException(
                'No category with name: '.$categoryName.' found in category\'s table.'
            );
        }
        else{
            $programs = $programRepository->findBy(['category' => $category->getId()],['id'=>'desc'], 3);
            // dd($programs);

            return $this->render('category/show.html.twig', [
            'programs' => $programs,
            'category' => $category,
        ]);
        }
        
    }
}