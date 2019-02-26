<?php

namespace Drupal\repec\Series;

/**
 * Base structure for templating classes.
 */
interface BaseInterface {

  /**
   * Returns the template structure.
   *
   * @return array
   *   The structure.
   */
  public function get();

}
