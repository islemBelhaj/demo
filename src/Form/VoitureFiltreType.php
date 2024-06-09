<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoitureFiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('couleur' , ChoiceType::class, [
                'choices'  => [
                    'couleur' => null,
                    'noir' => true,
                    'blanc' => false,
                ],
            ])


            ->add('id_Model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'model',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
