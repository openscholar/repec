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
    return array_merge([
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Chapter 1.0',
      ],
    ], parent::getDefault());
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Chapter';
  }

}
