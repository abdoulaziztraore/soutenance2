<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un Email',
                    ]),
                ],
            ])
            ->add('firstname', TextType::class,[
                'label' => 'Prenom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un prenom',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le nombre minimun de caractre: {{ limit }}',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez le nom',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nombre minimun de caractre: {{ limit }}',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('profile', TextType::class,[
                'label' => 'Profile',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez choisir le type de profile',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est obligatoire',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
