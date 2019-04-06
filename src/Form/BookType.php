<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seller', EntityType::class, [
                'class' => 'App:User',
                'disabled' => 'true'
            ])
            ->add('title')
            ->add('author')
            ->add('genre', EntityType::class, [
                'class' => 'App:Genre', // list objects from Genre class
                'choice_label' => 'type' // use the 'Genre.type' property as the visible option string
            ])
            ->add('image')
            ->add('isbn', IntegerType::class, [
                'label' => 'ISBN'
            ])
            ->add('summary')
            ->add('startingPrice', NumberType::class)
            ->add('reservePrice', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
