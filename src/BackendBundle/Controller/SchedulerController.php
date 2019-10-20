<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/scheduler")
 */
class SchedulerController extends Controller
{

  /**
   * @Route("/index")
   */
  public function indexAction()
  {
    $slots = [];
    $startDate = new \DateTime();
    $endDate = strtotime("+7 days");
    $workingHours = [14, 22];
    $minutes = [0, 15, 30, 45];
    $slot = 45;
    return $this->render('BackendBundle:Scheduler:index.html.twig', array(
          'start' => $startDate,
          'end' => $endDate,
          'workingHors' => $workingHours,
          'minutes' => $minutes,
          'slot' => $slot
            // ...
    ));
  }

  /**
   * @Route("/bookings")
   */
  public function bookingsAction()
  {
     $slots = [];
    $startDate = new \DateTime();
    $endDate = strtotime("+7 days");
    $workingHours = [14, 22];
    $minutes = [0, 15, 30, 45];
    $slot = 45;
    return $this->render('BackendBundle:Scheduler:bookings.html.twig', array(
          'start' => $startDate,
          'end' => $endDate,
          'workingHors' => $workingHours,
          'minutes' => $minutes,
          'slot' => $slot
            // ...
    ));
  }

}
