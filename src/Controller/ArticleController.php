<?php

namespace App\Controller;

use App\CRUD\Blog\ArticleCRUD;
use App\Entity\Article;
use App\Form\Blog\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("blog/article/showOne/{id}", name="blog_article_by_id")
     * @param ArticleCRUD $articleCRUD
     * @param int $id
     * @return Response
     */
    function showArticleById(ArticleCRUD $articleCRUD, int $id)
    {
        $article = $articleCRUD->getOneById($id);
        return $this->render('blog/articles/details.html.twig', ['article' => $article]);
    }

    /**
     * @Route("blog/article/showAll", name="blog_all_articles")
     * @param ArticleCRUD $articleCRUD
     * @return Response
     */
    function showAllArticles(ArticleCRUD $articleCRUD)
    {
        $articles = $articleCRUD->getAll();
        return $this->render('blog/articles/all.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("blog/article/create", name="blog_create_article")
     * @param Request $request
     * @param ArticleCRUD $articleCRUD
     * @return Response
     */
    function createArticle(Request $request, ArticleCRUD $articleCRUD)
    {
        $article = new Article();
        $form = $this->createForm(
            ArticleFormType::class,
            $article
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $articleCRUD->add($article);
            return $this->redirectToRoute('blog_all_articles');
        }
        return $this->render('blog/articles/create.html.twig',
            [
                'articleForm' => $form->createView()
            ]);
    }

    /**
     * @Route("blog/article/update/{id}", name="blog_update_article")
     * @param Request $request
     * @param ArticleCRUD $articleCRUD
     * @param int $id
     * @return Response
     */
    function updateArticle(Request $request, ArticleCRUD $articleCRUD, int $id)
    {
        $article = $articleCRUD->getOneById($id);
        $form = $this->createForm(
            ArticleFormType::class,
            $article
        );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $articleCRUD->update($article);
            return $this->redirectToRoute('blog_article_by_id', ['id' => $id]);
        }
        return $this->render('blog/articles/update.html.twig',
            [
                'articleForm' => $form->createView()
            ]);
    }

    /**
     * @Route("blog/article/delete/{id}", name="blog_delete_article")
     * @param ArticleCRUD $articleCRUD
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    function deleteArticle(ArticleCRUD $articleCRUD, int $id)
    {
        $article = $articleCRUD->getOneById($id);
        $articleCRUD->delete($article);
        return $this->redirectToRoute('blog_all_articles');
    }
}