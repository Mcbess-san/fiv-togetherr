<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
    /* @Route("/search", name="search", methods={"GET"})
     * @return Response
     */
    public function search(Request $request, CategoryRepository $categoryRepository): Response
    {
        $query = $request->query->get('q');
        if (null !== $query) {
            $categories = $categoryRepository->findByQuery($query);
        }
        return $this->render('home/index.html.twig', [
            'categories' => $categories ?? [],
        ]);
    }
    /* @Route("/autocomplete", name="autocomplete", methods={"GET"})
     * @return Response
     */
    public function autocomplete(Request $request, CategoryRepository $categoryRepository): Response
    {
        $query = $request->query->get('q');

        $categories = [];
        if (null !== $query) {
            $categories = $categoryRepository->findByQuery($query);
        }

        return $this->json($categories, 200);
    }
}
