<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/recette', name: 'recipe.index')]
    public function index(Request $request, RecipeRepository $repository, EntityManagerInterface $em): Response
    {
        // $recipes = $repository->findWithDurationLowerThan(100);
        // $recipes = $repository->findAll();
        dd($repository->findTotalDuration());
        // $recipes = $em->getRepository(Recipe::class)->findAll();
        
        // Modification du titre de la première recette
        // $recipes[0]->setTitle('Pates Bolognese');
        // $em->flush();
        
        // Ajouter un objet
        // $recipe = new Recipe();
        // $recipe->setTitle('Berbe a papa')
        // ->setSlug('Berbe-papa')
        // ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et ipsum id ipsum viverra aliquet. Duis pulvinar, velit a convallis posuere, dui lectus rutrum lectus, in cursus ex justo vel velit.')
        // ->setDuration(60)
        // ->setCreatedAt(new \DateTimeImmutable())
        // ->setUpdateAt(new \DateTimeImmutable());
        // $em->persist($recipe);
        // $em->flush();
        
        // Supprimer un objet
        // $em->remove($recipes[0]);
        // $em->flush();
        // return new Response('Recettes');
        return $this->render('recipe/index.html.twig',[
            "recipes" => $recipes
        ]);

    }
    #[Route('/recette/{slug}-{id}', name: 'recipe.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]
    public function show(Request $request, String $slug, int $id, RecipeRepository $repository): Response
    {
        $recipe = $repository->find($id);
        if ($recipe->getSlug() !== $slug) {
            
         return $this->redirectToRoute('recipe.show', ['slug'=>$recipe->getSlug(), 'id'=> $recipe->getId()]);;
        }
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
                // "id" => $id,
                // "slug" => $slug,
                // "personne" =>[
                //     "nom" => "John Doe",
                //     "age" => 30,
                //     "adresse" => "123 Main St"
                // ]
                "recipe" => $recipe
            ]
        );
    }
}