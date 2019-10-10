<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class, [
                    'label' => 'blog.forms.register.username',
                    'attr'  => [
                        'class' => ''
                    ]
                ]
            )
            ->add('password',
                RepeatedType::class, [
                    'type'            => PasswordType::class,
                    'invalid_message' => 'blog.forms.register.error.password_and_confirm_password_does_not_match',
                    'options'         => ['attr' => ['class' => '']],
                    'required'        => true,
                    'first_options'   => ['label' => 'blog.forms.register.password'],
                    'second_options'  => ['label' => 'blog.forms.register.repeat_password'],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'      => null,
            'csrf_protection' => false,
        ]);
    }
}