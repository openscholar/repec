<?php

namespace Drupal\repec;

use Drupal\repec\Series\BaseInterface;

/**
 * TemplateFactory.
 */
final class TemplateFactory {

  /**
   * Creates a new templating class.
   *
   * @param string $series_type
   *   The series type.
   *
   * @return \Drupal\repec\Series\BaseInterface
   *   The templating class.
   */
  public static function create($series_type) : BaseInterface {
    $template_class = "Drupal\\repec\\Series\\{$series_type}\\Template";
    return new $template_class();
  }

}
