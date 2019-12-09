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
    $workingHours = [];
    if ($config->getValue()) {
      $workingHours = json_decode($config->getValue(), true);
    }
    $form = $this->createFormBuilder($workingHours)
        ->add('Saturday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'sat']])
        ->add('SaturdayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'sat']])
        ->add('SaturdayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'sat']])
        ->add('Sunday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'sun']])
        ->add('SundayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'sun']])
        ->add('SundayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'sun']])
        ->add('Monday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'mon']])
        ->add('MondayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'mon']])
        ->add('MondayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'mon']])
        ->add('Tuesday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'tue']])
        ->add('TuesdayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'tue']])
        ->add('TuesdayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'tue']])
        ->add('Wednesday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'wed']])
        ->add('WednesdayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'wed']])
        ->add('WednesdayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'wed']])
        ->add('Thursday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'thu']])
        ->add('ThursdayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'thu']])
        ->add('ThursdayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'thu']])
        ->add('Friday', CheckboxType::class, ['required' => false, 'attr' => ['class' => 'fri']])
        ->add('FridayFrom', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'fri']])
        ->add('FridayTo', TimeType::class, ['input' => 'array', 'widget' => 'single_text', 'required' => false, 'attr' => ['class' => 'fri']])
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
