<?php

namespace Drupal\repec\Series;

/**
 * Contract for template classes.
 */
interface BaseInterface {

  /**
   * Returns the default template structure.
   *
   * @return array
   *   The structure.
   */
  public function getDefault() : array;

  /**
   * Creates the template.
   *
   * @param array $template
   *   The template structure.
   *
   * @throws \Drupal\repec\Series\CreateException
   */
  public function create(array $template);

}
