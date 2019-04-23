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
    return array_merge([
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Book 1.0',
      ],
    ], parent::getDefault());
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Book';
  }

}
