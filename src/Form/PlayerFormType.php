<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lest_name')
            ->add('first_name')
            ->add('picture')
            ->add('birth_date')
            ->add('club_entry_date')
            ->add('stats')
            ->add('license_number')
            // ->add('play_in')
            ->add('is_post')
            ->add('play_in', EntityType::class, [
                // looks for choices from this entity
                'class' => Team::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'category',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }


}
