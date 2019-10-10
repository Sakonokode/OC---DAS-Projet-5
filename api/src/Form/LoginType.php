<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class, [
                    'label' => 'app.form.login.email',
                    'attr' => [
                        'class' => 'ui text'
                    ]
                ]
            )
            ->add('password',
                PasswordType::class, [
                    'label' => 'app.form.login.password',
                    'attr' => [
                        'class' => 'ui text'
                    ]
                ])
            ->add(
                'submit',
                SubmitType::class, [
                    'attr' => [
                        'text' => 'app.buttons.register',
                        'class' => 'ui button',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'      => null,
            'csrf_protection' => false,
        ]);
    }
}