<?php

namespace App\Form;

use App\Entity\Match;
use App\Form\MatchStatsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('score',TextType::class,['label'=>'score'])
            ->add('reds',TextType::class,['label'=>'carton rouge'])
            ->add('yellows',TextType::class,['label'=>'carton jaune'])
            ->add('essais',TextType::class,['label'=>'essais realisés'])
            ->add('transformations',TextType::class,['label'=>'transfo reussis'])
            ->add('penalites',TextType::class,['label'=>'penalités'])
            ->add('drops',TextType::class,['label'=>'drops effectués'])
            ->add('drops',TextType::class,['label'=>'drops effectués'])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class,
        ]);
    }
}
