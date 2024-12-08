<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/recette', name: 'recipe.index')]
    public function index(Request $request): Response
    {
        // return new Response('Recettes');
        return $this->render('recipe/index.html.twig');

    }
    #[Route('/recette/{slug}-{id}', name: 'recipe.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]
    public function show(Request $request, String $slug, int $id): Response
    {
        // Récupération des données de la recette
        // return new JsonResponse(
        //     [
        //         "id"=>$id,
        //         "slug"=>$slug
        //     ]);
        //ou 
        // return $this->json(
        //     [
        //         "id" => $id,
        //         "slug" => $slug
        //     ]
        // );
        // return new Response('Recette : '. $slug);
        return $this->render(('recipe/show.html.twig'),
            [
                "id" => $id,
                "slug" => $slug,
                "personne" =>[
                    "nom" => "John Doe",
                    "age" => 30,
                    "adresse" => "123 Main St"
                ]
            ]
        );
    }
}