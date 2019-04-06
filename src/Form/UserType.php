<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('roles', ChoiceType::class, [
                'label' => 'Role',
                'mapped' => false,
                'required' => true,
                'choices' => [
                    'Please select a role' => '',
                    'Admin' => 'ROLE_ADMIN',
                    'Seller' => 'ROLE_SELLER',
                    'Buyer' => 'ROLE_BUYER'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
