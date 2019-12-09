<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

final class AvailabilityAdminController extends CRUDController
{

  public function availabilityAction()
  {
    return $this->renderWithExtraParams('BackendBundle::availability.html.twig');
  }

}
