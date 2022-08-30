<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'disabled' => true,
                'label' => 'Mon Nom Complet'
            ])

            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Mon addresse mail'
            ])

            ->add('telNumber', TelType::class, [
                'disabled' => 'true',
                'label' => 'Mon numéro de mobile'
            ])

            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mon mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
            ])

            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'required' => true,
                'mapped' => false,
                'constraints' => new Length(null,7,12),
                'first_options' => [
                    'label' => 'Mon nouveau Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre nouveau mot de passe'
                    ]
                ],
            ])

            ->add('submit',SubmitType::class, [
                'label' => 'Mettre à jour mon mot de passe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
