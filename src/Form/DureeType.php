<?php

namespace App\Form;

use App\Entity\Duree;
use App\Entity\Module;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DureeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbJours')
            // ->add('formation')
            ->add('modules', EntityType::class,[
                'class' => Module::class,
                'label' => false,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('m');
                    // ->orderBy('m.name', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Duree::class,
        ]);
    }
}
