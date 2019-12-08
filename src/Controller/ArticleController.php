<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController
{
    /**
     * @Route("blog/article/showOne/{id}", name="blog_article_by_id")
     * @param int $id
     * @return Response
     */
    function showArticleById(int $id)
    {
        $content = "<html><body>Id de l'article = $id</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }

    /**
     * @Route("blog/article/showAll", name="blog_all_articles")
     * @return Response
     */
    function showAllArticles()
    {
        $content = "<html><body>Show all articles.</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }

    /**
     * @Route("blog/article/create", name="blog_create_article")
     * @return Response
     */
    function createArticle()
    {
        $content = "<html><body>Create article</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }

    /**
     * @Route("blog/article/update/{id}", name="blog_update_article")
     * @param int $id
     * @return Response
     */
    function updateArticle(int $id)
    {
        $content = "<html><body>Modify article id = $id</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }

    /**
     * @Route("blog/article/delete/{id}", name="blog_delete_article")
     * @param int $id
     * @return Response
     */
    function deleteArticle(int $id)
    {
        $content = "<html><body>Delete article id = $id</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}