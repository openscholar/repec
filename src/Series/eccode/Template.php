<?php

namespace Drupal\repec\Series\eccode;

use Drupal\repec\Series\Base;

/**
 * Template software component article.
 */
class Template extends Base {

  /**
   * {@inheritdoc}
   */
  public function getDefault(): array {
    /** @var array $default */
    $default = parent::getDefault();
    $default[] = [
      'attribute' => 'Template-Type',
      'value' => 'ReDIF-Software 1.0',
    ];

    return $default;
  }

}
