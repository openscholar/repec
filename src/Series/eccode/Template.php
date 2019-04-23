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
    return array_merge([
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Software 1.0',
      ],
    ], parent::getDefault());
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Software';
  }

}
