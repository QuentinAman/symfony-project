<?php

namespace App\CRUD\Blog;

use App\Entity\Article;
use App\Repository\Blog\ArticleRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleCRUD
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ArticleRepository|ObjectRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository('App:Article');
    }

    private function persist(Article $article): void
    {
        $this->em->persist($article);
        $this->em->flush();
    }

    public function add(Article $article): void
    {
        $this->persist($article);
    }

    public function update(Article $article): void
    {
        $this->persist($article);
    }

    public function getOneById(int $id): Article
    {
        return  $this->repo->find($id);
    }

    public function getAll(): array
    {
        return $this->repo->findAll();
    }

    public function delete(Article $article): void
    {
        $this->em->remove($article);
        $this->em->flush();
    }
}