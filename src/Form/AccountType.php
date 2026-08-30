<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichImageType; //type de champ spécial VichUploader (gère l'aperçu de l'image existante + l'upload)

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
            ])

            ->add('imageFile', VichImageType::class, [
                'label' => 'Photo de profil',
                'required' => false, //l'utilisateur peut modifier son profil sans changer sa photo à chaque fois
                'allow_delete' => false, //pas d'option de suppression de photo sans la remplacer (une photo par défaut existe toujours)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}