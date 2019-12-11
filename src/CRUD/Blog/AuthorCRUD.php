<?php

namespace App\CRUD\Blog;

use App\Entity\Author;
use App\Repository\Blog\AuthorRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class AuthorCRUD
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var AuthorRepository|ObjectRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository('App:Author');
    }

    private function persist(Author $author): void
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    public function add(Author $author): void
    {
        $this->persist($author);
    }

    public function update(Author $author): void
    {
        $this->persist($author);
    }

    public function getOneById(int $id): Author
    {
        return  $this->repo->find($id);
    }

    public function getAll(): array
    {
        return $this->repo->findAll();
    }

    public function delete(Author $author): void
    {
        $this->em->remove($author);
        $this->em->flush();
    }
}