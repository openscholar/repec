<?php

namespace Drupal\repec;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\repec\Series\Base;
use Drupal\repec\Series\BaseInterface;
use Drupal\Core\File\FileSystemInterface;

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
   * Drupal\Core\File\FileSystemInterface definition.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

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
  public function __construct(EntityTypeManagerInterface $entity_type_manager, ConfigFactoryInterface $config_factory, MessengerInterface $messenger, FileSystemInterface $file_system) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
    $this->fileSystem = $file_system;
  }

  /**
   * Creates a new templating class.
   *
   * @param string $series_type
   *   The series type.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity used for generating the template.
   *
   * @return \Drupal\repec\Series\BaseInterface
   *   The templating class.
   */
  public function create($series_type, ContentEntityInterface $entity) : BaseInterface {
    $template_class = "Drupal\\repec\\Series\\$series_type\\Template";
    /** @var \Drupal\Core\Config\ImmutableConfig $repec_settings */
    $repec_settings = $this->configFactory->get('repec.settings');
    /** @var array|null $bundle_settings */
    $bundle_settings = unserialize($repec_settings->get("repec_bundle.{$entity->getEntityTypeId()}.{$entity->bundle()}"), ['array']);
    return new $template_class($repec_settings, $this->entityTypeManager, $this->messenger, $entity, $bundle_settings, $this->fileSystem);
  }

}
