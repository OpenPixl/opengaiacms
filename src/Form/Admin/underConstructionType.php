<?php

namespace App\Form\Admin;

use App\Entity\Admin\UnderConstruction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class underConstructionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title1', TextType::class, [
                'label' => 'Titre principal',
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'value' => 'Site en cours de construction'
                ],
                'required' => true
            ])
            ->add('title2', TextType::class, [
                'label' => 'Sous titre',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description pour le référencememt',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => true
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de la page',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => true
            ])
            ->add('contactPhone', TextType::class, [
                'label' => 'Numéro de telephone pour tous contacts',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
            ->add('contactMail', TextType::class, [
                'label' => 'Adresse mail pour un contact',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
            ->add('contactFb', TextType::class, [
                'label' => 'Lien vers votre page Facebook',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
            ->add('contactInst', TextType::class, [
                'label' => 'Lien vers votre page Instagram',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
            ->add('contactMasto', TextType::class, [
                'label' => 'Lien vers votre page Mastodon',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
            ->add('contactXtweet', TextType::class, [
                'label' => 'Lien vers votre page X (Tweeter)',
                'attr' => [
                    'class' => 'form-control form-control-sm'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UnderConstruction::class,
        ]);
    }
}
