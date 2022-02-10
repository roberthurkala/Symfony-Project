<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', null, [
                'label' => 'user.field.enabled'
            ])
            ->add('email', null, [
                'label' => 'user.field.email'
            ])
            ->add('firstName', null, [
                'label' => 'user.field.first_name'
            ])
            ->add('lastName', null, [
                'label' => 'user.field.last_name'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'user.field.roles',
                'choices' => User::getAllRoles(),
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'user.password.mismatch',
                'required' => true,
                'first_options' => ['label' => 'user.field.password'],
                'second_options' => ['label' => 'user.field.rpassword'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
