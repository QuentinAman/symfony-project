<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthorController
 * @package App\Controller
 */
class AuthorController
{
    /**
     * @Route("blog/author/{id}", name="get_author_by_id")
     * @param int $id
     * @return Response
     */
    function ShowAuthorById(int $id)
    {
        $content = "<html><body>Id de l'auteur = $id</body></html>";
        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}

