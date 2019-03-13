<?php

namespace Drupal\repec\Series\journl;

use Drupal\repec\Series\Base;

/**
 * Template journal article.
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
      'value' => 'ReDIF-Paper 1.0',
    ];

    return $default;
  }

}
