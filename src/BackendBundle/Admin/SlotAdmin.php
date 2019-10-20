<?php

declare(strict_types = 1);

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class SlotAdmin extends AbstractAdmin
{

  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
        ->add('name')
        ->add('startAt')
        ->add('endAt')
    ;
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
        ->add('name')
        ->add('startAt')
        ->add('endAt')
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
        ->add('startAt')
        ->add('endAt')
        ->add('instrument', EntityType::class, [
          'class' => \AppBundle\Entity\Instrument::class,
          'query_builder' => function(\AppBundle\Repository\InstrumentRepository $er) {
            return $er->queryEnabled();
          },
          'multiple' => false
        ])
        ->add('room', EntityType::class, [
          'class' => \AppBundle\Entity\Room::class,
          'query_builder' => function(\AppBundle\Repository\RoomRepository $er) {
            return $er->queryEnabled();
          },
          'multiple' => false
        ])
        ->add('tutor', EntityType::class, [
          'class' => \AppBundle\Entity\Tutor::class,
          'query_builder' => function(\AppBundle\Repository\TutorRepository $er) {
            return $er->queryEnabled();
          },
          'multiple' => false
        ])
    ;
  }

  protected function configureShowFields(ShowMapper $showMapper): void
  {
    $showMapper
        ->add('name')
        ->add('startAt')
        ->add('endAt')
    ;
  }

}
