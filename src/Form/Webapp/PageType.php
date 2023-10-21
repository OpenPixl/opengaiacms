<?php

namespace App\Form\Webapp;

use App\Entity\Webapp\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('subtitle')
            ->add('state')
            ->add('isPublish')
            ->add('isShowTitle')
            ->add('IsShowDate')
            ->add('IsShowDescription')
            ->add('cssId')
            ->add('cssName')
            ->add('cssStyle')
            ->add('createdAt')
            ->add('updatedAt')
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
