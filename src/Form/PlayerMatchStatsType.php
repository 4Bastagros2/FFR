<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\PlayerMatchStats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerMatchStatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('lest_name')
            // ->add('first_name')
            // ->add('picture')
            // ->add('birth_date')
            // ->add('club_entry_date')
            ->add('essais')
            ->add('transformations')
            ->add('penalites')
            ->add('drops')
            ->add('rouges')
            ->add('jaunes')
            ->add('temps')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
            'id' => 'playerStat'
        ]);
    }
}
