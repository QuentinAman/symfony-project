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

    /**
     * AuthorCRUD constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository('App:Author');
    }

    /**
     * @param Author $author
     */
    private function persist(Author $author): void
    {
        $this->em->persist($author);
        $this->em->flush();
    }

    /**
     * @param Author $author
     */
    public function add(Author $author): void
    {
        $this->persist($author);
    }

    /**
     * @param Author $author
     */
    public function update(Author $author): void
    {
        $this->persist($author);
    }

    /**
     * @param int $id
     * @return Author
     */
    public function getOneById(int $id): Author
    {
        return  $this->repo->find($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->repo->findAll();
    }

    /**
     * @param Author $author
     */
    public function delete(Author $author): void
    {
        $this->em->remove($author);
        $this->em->flush();
    }
}