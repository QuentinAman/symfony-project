<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 * @ORM\Entity(repositoryClass="App\Repository\Blog\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     */
    private $id;

    /**
     * @Assert\Length(min="5", max="100", maxMessage="BLABLA")
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     * @var string
     */

    private $title;
    /**
     * @ORM\Column(name="content", type="text", nullable=false)
     * @var string
     */

    private $content;

    /**
     * @ORM\Column(name="date", type="string", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="articles")
     * @ORM\JoinColumn(name="id_author", referencedColumnName="id")
     * @var Author
     */
    private $author;

    public function __construct() {
        $this->date = date('Y-m-d');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

}