<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Team;
use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lest_name',TextType::class,['label'=>'Nom'])
            ->add('first_name',TextType::class,['label'=>'Prénom'])
            ->add('picture', FileType::class, array('data_class' => null,
                                                    'label'=>'Photo'
            
            ))
            ->add('birth_date',DateType::class,['label'=>'Date de naissance'])
            ->add('club_entry_date',DateType::class,['label'=>'Date d\'entrée au club'])
            // ->add('stats',TextType::class,['label'=>'Les statistiques du joueur'])
            ->add('license_number',NumberType::class,['label'=>'N° de license'])
            // ->add('play_in')
            ->add('is_post', EntityType::class, [
                // looks for choices from this entity
                'class' => Post::class,
                'label'=>'Postes occupés',
            
                // uses the User.username property as the visible option string
                'choice_label' => 'post',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('play_in', EntityType::class, [
                // looks for choices from this entity
                'class' => Team::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'category',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                'label'=>'Jouera en'
            ])
            ->add('Submit', SubmitType::class, ['label' => '+ Ajouter', 'attr' => ['class' => 'btn-lg pointer']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }


}
