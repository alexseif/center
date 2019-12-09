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
    $rules = [];
    $slots = [];
    $weekPeriod;
    foreach ($daysOfTheWeek as $key => $day) {
      if ($workingHours[$day]) {
        $startDate = new \DateTime($day . ' next week');
        $startDate->setTime((int) $workingHours[$day . "From"]['hour'], (int) $workingHours[$day . "From"]['minute'], 00);
        $endDate = new \DateTime($day . ' next week');
        $endDate->setTime((int) $workingHours[$day . "To"]['hour'], (int) $workingHours[$day . "To"]['minute'], 00);
        $weekPeriod[$startDate->format('d')]['start'] = $startDate;
        $weekPeriod[$startDate->format('d')]['end'] = $endDate;
        $rule = (new \Recurr\Rule())
            ->setWeekStart('SA')
            ->setStartDate($startDate)
            ->setUntil($endDate)
            ->setFreq('MINUTELY')
            ->setInterval(45)
        ;
        $rules[] = $rule;
        $transformer = new \Recurr\Transformer\ArrayTransformer();
        $slots[$day] = $transformer->transform($rule);
      } else {
        unset($daysOfTheWeek[$key]);
      }
    }
    ksort($weekPeriod);
    $reservations = $dm->getRepository('AppBundle:Reservation')->getByRange(reset($weekPeriod)['start'], end($weekPeriod)['end']);
//    foreach ($rules as $key => $rule) {
//      foreach ($reservations as $reservation) {
//        $rules[$key]->setExDates([$reservation->getStart()->format('c')]);
//      }
//    }

    return $this->renderWithExtraParams('BackendBundle::availability.html.twig', [
          'daysOfTheWeek' => $daysOfTheWeek,
          'rooms' => $rooms,
          'slots' => $slots,
          'reservations' => $reservations
    ]);
  }

}
