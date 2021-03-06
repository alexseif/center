<?php

declare(strict_types = 1);

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class ReservationAdmin extends AbstractAdmin
{

  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
        ->add('customer')
        ->add('course')
        ->add('start')
        ->add('room', null, array('admin_code' => 'backend.admin.room'))
    ;
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
        ->add('customer')
        ->add('course')
        ->add('start')
        ->add('room', null, array('admin_code' => 'backend.admin.room'))
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
        ->add('customer')
        ->add('course')
        ->add('start')
        ->add('room', 'sonata_type_model', array(), array(
          'admin_code' => 'backend.admin.room'
        ))
    ;
  }

  protected function configureShowFields(ShowMapper $showMapper): void
  {
    $showMapper
        ->add('customer')
        ->add('course')
        ->add('start')
        ->add('room', null, array('admin_code' => 'backend.admin.room'))
    ;
  }

}
