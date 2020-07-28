<?php

namespace App\Form;

use App\Entity\Match;
use App\Entity\MatchType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('duration')
            ->add('local_team')
            ->add('visitor_team')
            ->add('stats')
            ->add('composition')
            ->add('match_type',EntityType::class,[
                'class' => MatchType::class,
                'choice_label' => 'name',
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class,
        ]);
    }
}
