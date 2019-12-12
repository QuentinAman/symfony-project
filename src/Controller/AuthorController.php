<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\Blog\AuthorFormType;
use App\CRUD\Blog\AuthorCRUD;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller
 */
class AuthorController extends AbstractController
{
    /**
     * @Route("blog/author/", name="blog_all_authors")
     * @param AuthorCRUD $authorCRUD
     * @return Response
     */
    function ShowAllAuthors(AuthorCRUD $authorCRUD)
    {
        $authors = $authorCRUD->getAll();
        return $this->render('blog/authors/all.html.twig', ['authors' => $authors]);
    }

    /**
     * @Route("blog/author/showOne/{id}", name="blog_one_author")
     * @param AuthorCRUD $authorCRUD
     * @param int $id
     * @return Response
     */
    function ShowOneAuthor(AuthorCRUD $authorCRUD, int $id)
    {
        $author = $authorCRUD->getOneById($id);
        return $this->render('blog/authors/details.html.twig', ['author' => $author]);
    }

    /**
     * @Route("blog/author/create", name="blog_create_author")
     * @param Request $request
     * @param AuthorCRUD $authorCRUD
     * @return Response
     */
    function createAuthor(Request $request, AuthorCRUD $authorCRUD)
    {
        $author = new Author();
        $form = $this->createForm(
            AuthorFormType::class,
            $author
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $authorCRUD->add($author);
            return $this->redirectToRoute('blog_all_authors');
        }
        return $this->render('blog/authors/create.html.twig',
            [
                'auteurForm' => $form->createView()
            ]);
    }

    /**
     * @Route("blog/author/update/{id}", name="blog_update_author")
     * @param Request $request
     * @param AuthorCRUD $authorCRUD
     * @param int $id
     * @return Response
     */
    function updateAuthor(Request $request, AuthorCRUD $authorCRUD, int $id)
    {
        $author = $authorCRUD->getOneById($id);
        $form = $this->createForm(
            AuthorFormType::class,
            $author
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $authorCRUD->update($author);
            return $this->redirectToRoute('blog_one_author', ['id' => $id]);
        }
        return $this->render('blog/authors/update.html.twig',
            [
                'auteurForm' => $form->createView()
            ]);
    }

    /**
     * @Route("blog/author/delete/{id}", name="blog_delete_author")
     * @param AuthorCRUD $authorCRUD
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function deleteAuthor(AuthorCRUD $authorCRUD, int $id)
    {
        $author = $authorCRUD->getOneById($id);
        $authorCRUD->delete($author);
        return $this->redirectToRoute('blog_all_authors');
    }
}

