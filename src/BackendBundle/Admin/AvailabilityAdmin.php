<?php

declare(strict_types = 1);

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

final class AvailabilityAdmin extends AbstractAdmin
{

  protected $baseRoutePattern = 'availability_view';
  protected $baseRouteName = 'availability_view';

  protected function configureRoutes(RouteCollection $collection)
  {
    $collection->clear();
    $collection->add('availability', 'availability');
  }

  public function configureActionButtons($action, $object = null)
  {
    $list = parent::configureActionButtons($action, $object);

    $list['availability'] = [
      'template' => 'BackendBundle:buttons:availability_button.html.twig'
    ];

    return $list;
  }

  public function getDashboardActions()
  {
    $actions = parent::getDashboardActions();

    $actions['availability']['template'] = 'BackendBundle:buttons:availability_button.html.twig';

    return $actions;
  }

}
