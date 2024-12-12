<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findBySearchInTitle(string $search): array {
        $queryBuilder = $this->createQueryBuilder('recipe');
            // Sélectionne l'entité Recipe
        $query = $queryBuilder -> select('recipe')
                // Ajoute une condition pour les titres contenant le terme recherché
                -> where('recipe.title LIKE :search')
                // Définit le paramètre 'search' avec des jokers '%' autour de la valeur recherchée
                // pour permettre une recherche partielle dans le titre
                -> setParameter('search', '%'.$search.'%')
                // Génére la requete
                -> getQuery();

        return $query->getResult();
    }
}
