<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('category', ChoiceType::class, [
                'choices' =>[
                    'Grab'       => "Grab",
                    'Rotation'   => "Rotation",
                    'Flip'       => "Flip",
                    'Slide'      => "Slide",
                    'One-foot'   => "One-foot",
                    'Old-school' => "Old-school",
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
