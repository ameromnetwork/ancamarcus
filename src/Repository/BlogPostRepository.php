<?php

namespace App\Repository;

use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }
    
    public function findLatest(Tag $tag = null, Category $category = null)
    {
        $qb = $this->createQueryBuilder('bp')
            ->join('bp.tags', 't')
            ->join('bp.categories', 'c')
            ->where('bp.createdAt <= :now')
            ->orderBy('bp.createdAt', 'DESC')
            ->setParameter('now', new \DateTime())
        ;

//        dd($tag);
        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF bp.tags')
                ->setParameter('tag', $tag);
        }

        if (null !== $category) {
            $qb->andWhere(':category MEMBER OF bp.categories')
                ->setParameter('category', $category);
        }
        return $qb->getQuery()->getResult();
    }
}
