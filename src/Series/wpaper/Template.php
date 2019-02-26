<?php

namespace Drupal\repec\Series\wpaper;

use Drupal\repec\Series\BaseInterface;

/**
 * Template wpaper.
 */
class Template implements BaseInterface {

  /**
   * {@inheritdoc}
   */
  public function get() {
    return [
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Paper 1.0',
      ],
      [
        'attribute' => 'Title',
        'value' => 'something',
      ],
    ];
  }

}
