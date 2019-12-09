<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ReservationType extends AbstractType
{

  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
        ->add('start', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class, ['mapped' => FALSE])
        ->add('room', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class, ['mapped' => FALSE])
        ->add('customer', null, ['required' => TRUE])
        ->add('course', null, ['required' => TRUE])
    ;
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Reservation'
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
    return 'appbundle_reservation';
  }

}
