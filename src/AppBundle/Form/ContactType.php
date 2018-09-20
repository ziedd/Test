<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Text;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text',[
            'required' => true
        ])
            ->add('lastname', 'text',[
            'required' => true
        ])
            ->add("email", 'email',[
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact',
            'is_edit' => true,
            'csrf_protection' => true
        ));
    }

    public function getName()
    {
        return 'app_bundle_contact_type';
    }
}
