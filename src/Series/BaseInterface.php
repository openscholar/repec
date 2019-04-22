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
   * Returns the series type that is going to be used in template.
   *
   * See https://ideas.repec.org/t/seritemplate.html.
   *
   * @return string
   *   The series type.
   */
  public function getSeriesType(): string;

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
