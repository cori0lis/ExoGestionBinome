<?php

namespace App\Form;

use App\Entity\Duree;
use App\Entity\Module;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DureeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbJours', IntegerType::class)
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
