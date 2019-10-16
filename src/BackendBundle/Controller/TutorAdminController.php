<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

final class TutorAdminController extends CRUDController
{

  protected function configureFormFields(FormMapper $formMapper)
  {
    $formMapper
        ->add('name', TextType::class)
        ->add('enabled', CheckboxType::class)
    ;
  }

}
