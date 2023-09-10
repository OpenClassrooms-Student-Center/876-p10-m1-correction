<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Titre du projet'])
            ->add('employes', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => function (Employe $employe): string {
                    return $employe->getPrenom() . ' ' . $employe->getNom();
                },
                'multiple' => true,
                'label' => 'Inviter des membres',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
