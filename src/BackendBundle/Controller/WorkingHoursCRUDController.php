<?php

declare(strict_types = 1);

namespace BackendBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

final class WorkingHoursCRUDController extends CRUDController
{

  public function configAction(Request $request)
  {
    $dm = $this->getDoctrine()->getManager();
    $config = $dm->getRepository('AppBundle:Config')->find(1);
    $form = $this->createFormBuilder()
//        ->add('Saturday', CheckboxType::class)
        ->add('SaturdayFrom', TimeType::class)
        ->add('SaturdayTo', TimeType::class)
//        ->add('Sunday', CheckboxType::class)
        ->add('SundayFrom', TimeType::class)
        ->add('SundayTo', TimeType::class)
//        ->add('Monday', CheckboxType::class)
        ->add('MondayFrom', TimeType::class)
        ->add('MondayTo', TimeType::class)
//        ->add('Tuesday', CheckboxType::class)
        ->add('TuesdayFrom', TimeType::class)
        ->add('TuesdayTo', TimeType::class)
//        ->add('Wednesday', CheckboxType::class)
        ->add('WednesedayFrom', TimeType::class)
        ->add('WednesdayTo', TimeType::class)
//        ->add('Thursday', CheckboxType::class)
        ->add('ThursdayFrom', TimeType::class)
        ->add('ThursdayTo', TimeType::class)
//        ->add('Friday', CheckboxType::class)
        ->add('FridayFrom', TimeType::class)
        ->add('FridayTo', TimeType::class)
        ->add('save', SubmitType::class)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // $form->getData() holds the submitted values
      // but, the original `$task` variable has also been updated
      $workingHours = $form->getData();
      $config->setValue(json_encode($workingHours));
      $dm->flush();
      // ... perform some action, such as saving the task to the database
      // for example, if Task is a Doctrine entity, save it!
      // $entityManager = $this->getDoctrine()->getManager();
      // $entityManager->persist($task);
      // $entityManager->flush();

      return $this->redirectToRoute('working_hours_config');
    }

    return $this->renderWithExtraParams('admin/working_hours.html.twig', ['config' => $config, "form" => $form->createView()]);
  }

}
