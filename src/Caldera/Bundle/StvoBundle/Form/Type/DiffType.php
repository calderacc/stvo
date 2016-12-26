<?php

namespace Caldera\Bundle\StvoBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DiffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'oldVersion',
                EntityType::class,
                [
                    'class' => 'CalderaStvoBundle:Version',
                ]
            )
            ->add(
                'newVersion',
                EntityType::class,
                [
                    'class' => 'CalderaStvoBundle:Version',
                ]
            )
        ;
    }

    public function getName()
    {
        return 'diff';
    }
}