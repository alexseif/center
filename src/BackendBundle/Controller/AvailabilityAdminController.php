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
    $rooms = $dm->getRepository('AppBundle:Room')->getEnabled();

    $daysOfTheWeek = DateUtil::getDaysOFTheWeek();
    $config = $dm->getRepository('AppBundle:Config')->find(1);
    $workingHours = [];
    if ($config->getValue()) {
      $workingHours = json_decode($config->getValue(), true);
    } else {
      throw $this->createNotFoundException('Please configure your Working Hours');
    }
    $slots = [];
    foreach ($daysOfTheWeek as $key => $day) {
      $result = array_search($day, $workingHours);
      if ($workingHours[$day]) {
        $start = new \DateTime($day . ' next week');
        $end = new \DateTime($day . ' next week');
        $start->setTime((int) $workingHours[$day . "From"]['hour'], (int) $workingHours[$day . "From"]['minute'], 00);
        $end->setTime((int) $workingHours[$day . "To"]['hour'], (int) $workingHours[$day . "To"]['minute'], 00);
        $timeDiff = ($end->diff($start, true));
        $slotsCount = (int) ceil($timeDiff->h / 0.75);
        $timeslot = Timeslot::create($start, 0, 45);
        $collection = TimeslotCollection::create($timeslot, $slotsCount);
        $slots[$day] = $collection;
      } else {
        unset($daysOfTheWeek[$key]);
      }
    }
    return $this->renderWithExtraParams('BackendBundle::availability.html.twig', [
          'daysOfTheWeek' => $daysOfTheWeek,
          'rooms' => $rooms,
          'slots' => $slots
    ]);
  }

}
