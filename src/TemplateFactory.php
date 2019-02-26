<?php

namespace Drupal\repec;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\repec\Series\Base;

/**
 * TemplateFactory.
 */
final class TemplateFactory {

  /**
   * Creates a new templating class.
   *
   * @param string $series_type
   *   The series type.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity used for generating the template.
   *
   * @return \Drupal\repec\Series\Base
   *   The templating class.
   */
  public static function create($series_type, ContentEntityInterface $entity) : Base {
    /** @var \Drupal\Core\Config\ConfigFactoryInterface $config_factory */
    $config_factory = \Drupal::service('config.factory');
    /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager */
    $entity_type_manager = \Drupal::service('entity_type.manager');
    /** @var \Drupal\Core\Messenger\MessengerInterface $messenger */
    $messenger = \Drupal::service('messenger');

    $template_class = "Drupal\\repec\\Series\\$series_type\\Template";
    return new $template_class($config_factory->get('repec.settings'), $entity_type_manager, $messenger, $entity);
  }

}
