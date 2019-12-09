<?php

/*
 * The following content was designed & implemented under AlexSeif.com
 */

namespace BackendBundle\Util;

/**
 * Description of DateUtil
 *
 * @author Alex Seif <me@alexseif.com>
 */
class DateUtil
{

  //put your code here
  public static $daysOfTheWeek = [
    'saturday' => 'Saturday',
    'sunday' => 'Sunday',
    'monday' => 'Monday',
    'tuesday' => 'Tuesday',
    'wednesday' => 'Wednesday',
    'thursday' => 'Thursday',
    'friday' => 'Friday',
  ];

  public static function getDaysOFTheWeek()
  {
    return self::$daysOfTheWeek;
  }

}
