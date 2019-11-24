<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Timeslot\Timeslot;
use Timeslot\TimeslotCollection;

/**
 * @Route("/scheduler")
 */
class SchedulerController extends Controller
{

  /**
   * @Route("/")
   */
  public function indexAction()
  {
    $dm = $this->getDoctrine()->getManager();
    $form = $this->createFormBuilder()
        ->add('customer', EntityType::class, [
          'class' => 'AppBundle:Customer'
        ])
        ->add('course', EntityType::class, [
          'class' => 'AppBundle:CoursePrice'
        ])
        ->add('slot', \Symfony\Component\Form\Extension\Core\Type\HiddenType::class)
    ;
    $rooms = $dm->getRepository('AppBundle:Room')->findBy(['enabled' => true]);

    $timeslot = Timeslot::create('2019-11-24 10:00:00', 0, 45);
    $collection = TimeslotCollection::create($timeslot, 18);



    $slots = [];
    $slot = 45;
    return $this->render('BackendBundle:Scheduler:index.html.twig', array(
          'form' => $form->getForm()->createView(),
          'rooms' => $rooms,
          'slot' => $slot,
          'timeslot' => $timeslot,
          'collection' => $collection
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
