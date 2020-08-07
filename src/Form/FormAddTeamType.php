<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Season;
use App\Entity\MatchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormAddTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {




        $builder
        ->add('category',TextType::class,['label'=>'La category de la nouvelle equipe'])
        ->add('play_season',EntityType::class,[
            'class' => Season::class,
            'choice_label' => 'name',
            'label'=>'Choisissez la saison'
            ])
        ->add('Submit', SubmitType::class)
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
