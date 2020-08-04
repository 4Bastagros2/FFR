<?php

namespace App\Form;

use App\Entity\Match;
use App\Form\MatchStatsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stats',TextType::class,['label'=>'score'])
            ->add('stats',TextType::class,['label'=>'carton rouge'])
            ->add('stats',TextType::class,['label'=>'carton jaune'])
            ->add('stats',TextType::class,['label'=>'essais realisés'])
            ->add('stats',TextType::class,['label'=>'transfo reussis'])
            ->add('stats',TextType::class,['label'=>'penalités'])
            ->add('stats',TextType::class,['label'=>'drops effectués'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class,
        ]);
    }
}
