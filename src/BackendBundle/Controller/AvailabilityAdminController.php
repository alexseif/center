<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Util\DateUtil;

final class AvailabilityAdminController extends CRUDController
{

  public function getDaysOfTheWeek()
  {
    return DateUtil::getDaysOFTheWeek();
  }

  public function getRooms()
  {
    $dm = $this->getDoctrine()->getManager();
    return $dm->getRepository('AppBundle:Room')->getEnabled();
  }

  public function getWorkingHours()
  {
    $dm = $this->getDoctrine()->getManager();
    $config = $dm->getRepository('AppBundle:Config')->find(1);

    $workingHours = [];
    if ($config->getValue()) {
      $workingHours = json_decode($config->getValue(), true);
    } else {
      throw $this->createNotFoundException('Please configure your Working Hours');
    }
    return $workingHours;
  }

  public function availabilityAction(Request $request)
  {
    $dm = $this->getDoctrine()->getManager();

    $newReservation = new \AppBundle\Entity\Reservation();
    $reservationForm = $this->createForm(\AppBundle\Form\ReservationType::class, $newReservation)
        ->add('Reserve', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
    ;
    $daysOfTheWeek = $this->getDaysOfTheWeek();
    $rooms = $this->getRooms();
    $workingHours = $this->getWorkingHours();

    /** Calculate slots and Work days */
    $rules = [];
    $slots = [];
    $weekPeriod = [];
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
    //    $nextWeek = new \DateTime(reset($daysOfTheWeek) . ' next week');
    //    $nextWeek->add(new \DateInterval('P1W'));
    //    dump($nextWeek->format('d-m-y'));
    $reservations = $dm->getRepository('AppBundle:Reservation')->getByRange(reset($weekPeriod)['start'], end($weekPeriod)['end']);

    $reservationForm->handleRequest($request);
    if ($reservationForm->isSubmitted() && $reservationForm->isValid()) {
      $newReservation->setRoom($dm->getRepository('AppBundle:Room')->findOneBy(['name' => $reservationForm->get('room')->getData(), 'enabled' => true]));
      $newReservation->setStart(new \DateTime($reservationForm->get('start')->getData()));
      if ($newReservation->getCustomer() && $newReservation->getCourse()) {
        $dm->persist($newReservation);
        $dm->flush();
      }
    }

    return $this->renderWithExtraParams('BackendBundle::availability.html.twig', [
          'daysOfTheWeek' => $daysOfTheWeek,
          'rooms' => $rooms,
          'slots' => $slots,
          'reservations' => $reservations,
          'reservationFrom' => $reservationForm->createView()
    ]);
  }

}
