<?php

namespace App\Form\Blog;

use App\Entity\Article;
use App\Entity\Author;
use App\Repository\Blog\AuthorRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                [
                    'required' => true
                ])
            ->add('content', TextareaType::class,
                [
                    'required' => true
                ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'query_builder' => function (AuthorRepository $er) {
                    return $er->createQueryBuilder('author')
                        ->orderBy('author.id', 'ASC');
                },
                'choice_label' => 'firstname'
            ])
            ->add('Valider', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}
