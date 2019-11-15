<?php

declare(strict_types = 1);

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CourseAdmin extends AbstractAdmin
{

  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
        ->add('name')
        ->add('days')
        ->add('enabled')
    ;
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
        ->add('name')
        ->add('days')
        ->add('enabled')
        ->add('_action', null, [
          'actions' => [
            'show' => [],
            'edit' => [],
            'delete' => [],
          ],
        ])
    ;
  }

  protected function configureFormFields(FormMapper $formMapper): void
  {
    $formMapper
        ->add('name')
        ->add('days')
        ->add('prices', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
          'by_reference' => false, // Use this because of reasons
          'allow_add' => true, // True if you want allow adding new entries to the collection
          'allow_delete' => true, // True if you want to allow deleting entries
          'prototype' => true, // True if you want to use a custom form type
          'entry_type' => \AppBundle\Form\CoursePriceType::class, // Form type for the Entity that is being attached to the object
        ])
//        ->add('prices')
        ->add('enabled')
    ;
  }

  protected function configureShowFields(ShowMapper $showMapper): void
  {
    $showMapper
        ->add('name')
        ->add('days')
        ->add('prices')
        ->add('enabled')
        ->add('createdAt')
        ->add('updatedAt')
    ;
  }

  public function prePersist($object)
  {
    foreach ($object->getPrices() as $price) {
      $price->setName($object->getName() . " - " . $price->getInstrument() . " - " . $price->getTutor());
      $price->setCourse($object);
    }
  }

  public function preUpdate($object)
  {
    foreach ($object->getPrices() as $price) {
      $price->setName($object->getName() . " - " . $price->getInstrument() . " - " . $price->getTutor());
      $price->setCourse($object);
    }
  }

}
