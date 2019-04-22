<?php

namespace Drupal\repec\Series\ecchap;

use Drupal\repec\Series\Base;

/**
 * Template for book chapter.
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
      'value' => 'ReDIF-Chapter 1.0',
    ];

    return $default;
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Chapter';
  }

}
