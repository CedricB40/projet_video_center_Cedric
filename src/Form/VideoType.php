<?php

namespace App\Form;

use App\Entity\Video; //on ajout le use de Video

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
            ])
            ->add('videoLink', null, [
                'label' => 'Lien vidéo',
                'help' => 'Collez le lien au format "embed" (ex : https://www.youtube.com/embed/XXXXXXXXXXX), pas le lien classique "watch?v=".',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('premiumVideo', CheckboxType::class, [
                'required' => false,
            ])

            // suppression des createdAt et updatedAt car gérés automatiquement par le trait TimestampableTrait

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
