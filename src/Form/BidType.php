<?php

namespace App\Form;

use App\Entity\Bid;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('timestamp', DateTimeType::class, [
                'label' => 'Bid Time',
                'input'  => 'datetime',
                'disabled'  => 'true',
                'widget' => 'single_text',
                'format' => 'dd MMM yy - HH:mm:ss',
                'data' => new \DateTime("now")
            ])
            ->add('buyer', EntityType::class, [
                'label' => 'Bidder',
                'class' => 'App:User',
                'disabled' => 'true'
            ])
            ->add('auctionItem', EntityType::class, [
                'label' => 'Auction Item',
                'class' => 'App:Book',
                'disabled' => 'true'
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Bid Amount',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bid::class,
        ]);
    }
}
