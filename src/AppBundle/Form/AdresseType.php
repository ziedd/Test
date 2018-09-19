<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ville', 'text',[
            'required' => true
        ])
            ->add("codePostal", 'text',[
                'required' => true
            ])
        ->add("rue", 'text',[
        'required' => true
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Adresse',
            'is_edit' => true,
            'csrf_protection' => true
        ));
    }

    public function getName()
    {
        return 'app_bundle_adresse';
    }
}
