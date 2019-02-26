<?php

namespace Drupal\repec\Series;

use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Base structure for templating classes.
 */
abstract class Base {

  use StringTranslationTrait;

  /**
   * Repec settings.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $settings;

  /**
   * Entity used for generating the template.
   *
   * @var \Drupal\Core\Entity\ContentEntityInterface
   */
  protected $entity;

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
   * Base constructor.
   *
   * @param \Drupal\Core\Config\ImmutableConfig $settings
   *   Repec settings.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   Entity type manager.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   Messenger.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity.
   */
  public function __construct(ImmutableConfig $settings, EntityTypeManagerInterface $entity_type_manager, MessengerInterface $messenger, ContentEntityInterface $entity) {
    $this->settings = $settings;
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
    $this->entity = $entity;
  }

  /**
   * Returns the template structure.
   *
   * @return array
   *   The structure.
   */
  abstract public function get() : array;

}
