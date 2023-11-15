<?php

namespace App\Form\Webapp;

use App\Entity\Webapp\Page;
use App\Entity\Webapp\Pagechoice;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('state', ChoiceType::class,[
                'choices' => [
                    'Publiée' => 'publish',
                    'En correction' => 'in_corrected',
                    'Brouillon' => 'draft',
                ],
                'label' => "Statut",
                'required' => false,
                'data' => 'draft'
            ])
            ->add('isMenu', CheckboxType::class, [
                'label' => 'Faire de cette page un menu ?',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('isShowTitle', CheckboxType::class, [
                'label' => 'Afficher le titre ?',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('IsShowDate', CheckboxType::class, [
                'label' => 'Afficher la date de publication ?',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('IsShowDescription', CheckboxType::class, [
                'label' => 'Afficher la description ?',
                'label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ],
            ])
            ->add('cssId')
            ->add('cssName')
            ->add('cssStyle')
            ->add('parent', EntityType::class, [
                'label'=> 'Page parente ?',
                'required' => false,
                'class' => Page::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'choice_attr' => function (Page $page, $key, $index) {
                    return ['data-data' => $page->getName() ];
                },
                'placeholder' => 'Aucune',
            ])
            ->add('seoTitle')
            ->add('seoDescription')
            ->add('seoKeywords')
            ->add('pagechoice', EntityType::class, [
                'label'=> 'Quel type de page souhaitez vous créer ?',
                'required' => false,
                'class' => Pagechoice::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'choice_attr' => function (Pagechoice $pagechoice, $key, $index) {
                    return ['data-data' => $pagechoice->getName() ];
                },
                'placeholder' => 'A définir',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
