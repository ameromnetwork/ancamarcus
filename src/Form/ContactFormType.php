<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/10/2018
 * Time: 2:46 AM.
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('completeName', null, array('attr' => array('class' => 'form-control', 'placeholder' => 'Your Name *')))
            ->add('email', null, array('attr' => array('class' => 'form-control', 'placeholder' => 'Your Email *')))
            ->add('subject', null, array('attr' => array('class' => 'form-control', 'placeholder' => 'Subject')))
            ->add('message', null, array('attr' => array('class' => 'form-control', 'placeholder' => 'Message')));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Contact',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact_form_type';
    }
}
