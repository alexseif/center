<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

  /**
   * @Route("/")
   */
  public function indexAction()
  {
    return $this->render('BackendBundle:Default:index.html.twig');
  }

  /**
   * @Route("getReservations", name="get_reservations")
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function getReservations()
  {

    $dm = $this->getDoctrine()->getManager();

    $reservations = $dm->getRepository('AppBundle:Reservation')->findAllWithJoins();
    $resArr = [];
    foreach ($reservations as $reservation) {
      $tmpArr = [
        'id' => $reservation->getId(),
        'start' => $reservation->getStart()->format('c'),
        'room' => $reservation->getRoom()->getName()
      ];
      $resArr[] = $tmpArr;
    }
    return new \Symfony\Component\HttpFoundation\JsonResponse(['reservations' => $resArr]);
  }

}
