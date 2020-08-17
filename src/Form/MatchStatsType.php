<?php

namespace App\Form;

use App\Entity\Match;
use App\Entity\Player;
use App\Form\MatchStatsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('score',TextType::class,['label'=>'score'])
            // ->add('reds',TextType::class,['label'=>'carton rouge'])
            // ->add('yellows',TextType::class,['label'=>'carton jaune'])
            // ->add('essais',TextType::class,['label'=>'essais realisés'])
            // ->add('transformations',TextType::class,['label'=>'transfo reussis'])
            // ->add('penalites',TextType::class,['label'=>'penalités'])
            // ->add('drops',TextType::class,['label'=>'drops effectués'])
            // ->add('drops',TextType::class,['label'=>'drops effectués'])
            // 'entry_type'   => PlayerMatchStatsType::class,
            // 'data_class' => Player::class,
            ->add('players', CollectionType::class, [
                'label'        => 'Statistiques des joueurs',
                'entry_type'   => PlayerMatchStatsType::class,
                'entry_options' => [
                    'attr' => [
                        'class' => 'player', // we want to use 'tr.item' as collection elements' selector
                    ],
                ],
                'allow_add'    => false,
                'allow_delete' => false,
                'prototype'    => true,
                'required'     => false,
                'attr' => [
                    'class' => 'table player-collection',
                ],
                
                ])
                // 'by_reference' => true,
                // 'delete_empty' => true,
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Match::class,
    //         // 'data_class' => 'Fuz\AppBundle\Entity\Basic\InATable\DiscountCollection',
    //     ]);
    // }
}
