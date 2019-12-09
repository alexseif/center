<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Timeslot\Timeslot;
use Timeslot\TimeslotCollection;

final class AvailabilityAdminController extends CRUDController
{

  public function availabilityAction()
  {
    $dm = $this->getDoctrine()->getManager();
    $timeslot = Timeslot::create($start, 0, 45);
    $collection = TimeslotCollection::create($timeslot, 18);
    return $this->renderWithExtraParams('BackendBundle::availability.html.twig');
  }

}
