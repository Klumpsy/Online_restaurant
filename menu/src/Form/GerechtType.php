<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Gerecht;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GerechtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gerecht')
            ->add('image', FileType::class, ['mapped' => false])
            ->add('beschrijving')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class
            ])
            ->add('Prijs')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gerecht::class,
        ]);
    }
}
