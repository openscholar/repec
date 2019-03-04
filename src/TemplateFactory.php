<?php

namespace Drupal\repec;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\repec\Series\Base;

/**
 * TemplateFactory.
 */
final class TemplateFactory {

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * TemplateFactory constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   Entity type manager.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   Messenger.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, ConfigFactoryInterface $config_factory, MessengerInterface $messenger) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
  }

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
  public function create($series_type, ContentEntityInterface $entity) : Base {
    $template_class = "Drupal\\repec\\Series\\$series_type\\Template";
    return new $template_class($this->configFactory->get('repec.settings'), $this->entityTypeManager, $this->messenger, $entity);
  }

}