<?php

namespace Drupal\repec\Series\ecbook;

use Drupal\repec\Series\Base;

/**
 * Template class for ecbook.
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
      'value' => 'ReDIF-Book 1.0',
    ];

    return $default;
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Book';
  }

}
