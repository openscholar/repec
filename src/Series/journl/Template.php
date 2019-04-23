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
    return array_merge([
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Paper 1.0',
      ],
    ], parent::getDefault());
  }

  /**
   * {@inheritdoc}
   */
  public function getSeriesType(): string {
    return 'ReDIF-Article';
  }

}
