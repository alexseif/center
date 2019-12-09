<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Timeslot\Timeslot;
use Timeslot\TimeslotCollection;
use BackendBundle\Util\DateUtil;

final class AvailabilityAdminController extends CRUDController
{

  public function availabilityAction()
  {
    $dm = $this->getDoctrine()->getManager();
    $daysOfTheWeek = DateUtil::getDaysOFTheWeek();
    $rooms = $dm->getRepository('AppBundle:Room')->findAll();
    $slots = [];
    foreach ($daysOfTheWeek as $day) {
      $start = new \DateTime($day . ' next week');
      $start->setTime(10, 00, 00);
      $timeslot = Timeslot::create($start, 0, 45);
      $collection = TimeslotCollection::create($timeslot, 18);
      $slots[$day] = $collection;
    }
    return $this->renderWithExtraParams('BackendBundle::availability.html.twig', [
          'daysOfTheWeek' => $daysOfTheWeek,
          'rooms' => $rooms,
          'slots' => $slots
    ]);
  }

}
