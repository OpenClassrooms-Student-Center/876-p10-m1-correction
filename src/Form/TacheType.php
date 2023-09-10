<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\Employe;
use App\Entity\Statut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['label' => 'Titre de la tâche'])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('deadline', DateType::class, ['label' => 'Date', 'widget' => 'single_text', 'required' => false])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'libelle',
            ])
            ->add('employe', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function (Employe $employe): string {
                    return $employe->getPrenom() . ' ' . $employe->getNom();
                },
                'choices' => $options['projet']->getEmployes(),
                'label' => 'Membre',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            'projet' => null,
        ]);
        $resolver->setAllowedTypes('projet', 'App\Entity\Projet');

    }
}
