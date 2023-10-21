<?php

namespace App\Form\Webapp;

use App\Entity\Webapp\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Titre de la page'
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Soustitre de la page'
            ])
            ->add('state')
            ->add('isPublish', CheckboxType::class, [
                'label' => 'Page publiée ?'
            ])
            ->add('isShowTitle')
            ->add('IsShowDate')
            ->add('IsShowDescription')
            ->add('cssId')
            ->add('cssName')
            ->add('cssStyle')
            ->add('parent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
