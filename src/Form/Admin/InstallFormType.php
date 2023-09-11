<?php

namespace App\Form\Admin;

use App\Entity\Admin\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class InstallFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameSite', TextType::class, [
                'label' => 'Quel est le nom de votre association / structure ?',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('slogan', TextType::class, [
                'label' => "Avez-vous un slogan ?",
                'help'=> 'si oui, completez ce champ',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'help_attr' => [
                    'class' => 'form-text'
                ]
            ])
            ->add('webmasterFirstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'mapped' => false
            ])
            ->add('webmasterLastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'mapped' => false
            ])
            ->add('webmasterMail', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'mapped' => false
            ])
            ->add('host', TextType::class, [
                'label' => 'Nom de domaine',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'mapped' => false
            ])
            ->add('dbhost', TextType::class, [
                'label' => 'Adresse de la base de donnée',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'mapped' => false
            ])
            ->add('webmasterPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ],
                'second_options' => [
                    'label' => 'Répétez le mot de passe',
                    'attr' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ],
                'mapped' => false
            ])
            ->add('logoFile', FileType::class,[
                'label' => 'Logo de l\'association',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '10000k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'Attention, veuillez charger un fichier au format jpg ou png',
                    ])
                ],
                'help' => 'Veuillez charger des images uniquement au format jpg, jpeg ou png pour l\'instant',
                'help_attr' => [
                    'class' => 'form-text'
                ]
            ])
            ->add('isSupprLogo', CheckboxType::class,[
                'label' => 'Supprimer le logo de l\'association / de la structure',
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
