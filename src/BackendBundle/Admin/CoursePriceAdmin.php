<?php

declare(strict_types = 1);

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CoursePriceAdmin extends AbstractAdmin
{

  protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
  {
    $datagridMapper
        ->add('name')
        ->add('price')
        ->add('enabled')
    ;
  }

  protected function configureListFields(ListMapper $listMapper): void
  {
    $listMapper
        ->add('name')
        ->add('price')
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
        ->add('course')
        ->add('instrument')
        ->add('tutor')
        ->add('price')
        ->add('enabled')
    ;
  }

  protected function configureShowFields(ShowMapper $showMapper): void
  {
    $showMapper
        ->add('name')
        ->add('price')
        ->add('enabled')
        ->add('createdAt')
        ->add('updatedAt')
        ->add('createdBy')
        ->add('updatedBy')
    ;
  }

  public function preValidate($coursePrice)
  {
    $coursePrice->setName($coursePrice->getCourse()->getName() . ' - ' . $coursePrice->getInstrument()->getName() . ' - ' . $coursePrice->getTutor()->getName());
  }

}
