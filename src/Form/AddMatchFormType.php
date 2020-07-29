<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\User;
use App\Entity\Match;
use App\Entity\MatchType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AddMatchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('date')
            ->add('duration')
            ->add('domicile', CheckboxType::class, [
                'mapped' => false,
                'required'=>false
            ])
            ->add('local_team',TextType::class,['label'=>'Equipe adverse'])
            
            // ->add('stats')
            // ->add('composition')
            // ->add('match_type',EntityType::class,[
            //     'class' => MatchType::class,
            //     'choice_label' => 'name',
            // ])
            ->add('teams',EntityType::class,[
                'class' => Team::class,
                'choices' => $options['teams'],
                'multiple' => true,
                'expanded' => false,                
                'choice_label' => 'category',
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Match::class,
            'teams' => Collection::class,
        ]);
    }
}
