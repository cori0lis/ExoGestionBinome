<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'required' => true
            ])
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Femme' => 'F',
                    'Homme' => 'M'
                ],
                'required' => true
            ])
            ->add('dateNaissance', DateType::class, [
                'years' => range(date('Y'), date('Y') - 100),
                'label' => 'Date de naissance',
                'format' => 'ddMMMMyyyy',
                'required' => true
            ])
            ->add('ville', TextType::class, [
                'required' => true
            ])
            ->add('adresse', TextType::class, [
                'required' => true
            ])
            ->add('cp', TextType::class, [
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'required' => true
            ])
            ->add('telephone', TextType::class, [
                'required' => true
            ])
            // ->add('sessions')
            ->add('valider', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
