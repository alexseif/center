<?php

/*
 * The following content was designed & implemented under AlexSeif.com
 */

namespace BackendBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Description of WorkingHoursAdmin
 *
 * @author Alex Seif <me@alexseif.com>
 */
class WorkingHoursAdmin extends AbstractAdmin
{

  protected $baseRoutePattern = 'working_hours';
  protected $baseRouteName = 'working_hours';

  protected function configureRoutes(RouteCollection $collection)
  {
    $collection->clear();
    $collection->add('config');
  }

}
