<?php
namespace App\Tests\CRUD\Blog;

use App\CRUD\Blog\ArticleCRUD;
use App\CRUD\Blog\AuthorCRUD;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleCRUDTest extends WebTestCase
{
    /**
     * @var ArticleCRUD
     */
    private $articleCRUD;

    /**
     * @var AuthorCRUD
     */
    private $authorCRUD;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::$container;

        $this->articleCRUD = $container
            ->get(ArticleCRUD::class);
        $this->authorCRUD = $container
            ->get(AuthorCRUD::class);
    }

    /**
     * @test
     */
    public function testAddArticleSuccessful()
    {
        $authors = $this->authorCRUD->getAll();
        $author = $authors[0];

        $article = new Article();
        $article->setTitle("test title");
        $article->setContent("test content");
        $article->setDate(date('Y-m-d'));
        $article->setAuthor($author);

        $this->articleCRUD->add($article);

        $articleFromDb = $this->articleCRUD->getOneById($article->getId());


        $this->assertEquals(
            $article->getTitle(),
            $articleFromDb->getTitle()
        );
    }

    public function testUpdateArticleSuccessful()
    {
        $articles = $this->articleCRUD->getAll();
        $article = $articles[0];

        $article->setTitle('Test');
        $this->articleCRUD->update($article->getId());

        $articleFromDb = $this->articleCRUD->getOneById($article->getId());

        
    }
}