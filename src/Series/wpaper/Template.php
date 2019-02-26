<?php

namespace Drupal\repec\Series\wpaper;

use Drupal\repec\Series\Base;

/**
 * Template wpaper.
 */
class Template extends Base {

  /**
   * {@inheritdoc}
   */
  public function get() : array {
    $result = [
      [
        'attribute' => 'Template-Type',
        'value' => 'ReDIF-Paper 1.0',
      ],
      [
        'attribute' => 'Title',
        'value' => $this->entity->label(),
      ],
      [
        'attribute' => 'Number',
        // Entity id cannot be used here as there could be
        // probably several entity types in a further release.
        'value' => $this->entity->uuid(),
      ],
      [
        'attribute' => 'Handle',
        'value' => 'RePEc:' . $this->settings->get('archive_code') . ':wpaper:' . $this->entity->id(),
      ],
    ];

    return $result;
  }

}
