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
   * Returns the default template structure.
   *
   * @return array
   *   The structure.
   */
  abstract public function getDefault() : array;

  /**
   * Creates the template.
   *
   * @param array $template
   *   The template structure.
   *
   * @throws \Drupal\repec\Series\CreateException
   */
  public function create(array $template) {
    /** @var array $bundle_settings */
    // The following is already done in
    // \Drupal\repec\Repec::getEntityBundleSettings
    // TODO: Move this to a parent service or something.
    $bundle_settings = unserialize($this->settings->get("repec_bundle.{$this->entity->getEntityTypeId()}.{$this->entity->bundle()}"));

    /** @var string $serie_directory_config */
    $serie_directory_config = $bundle_settings['serie_directory'];

    $archive_directory = "public://{$this->settings->get('base_path')}/{$this->settings->get('archive_code')}/";

    $directory = "{$archive_directory}{$serie_directory_config}/";

    if (!file_prepare_directory($directory, FILE_CREATE_DIRECTORY)) {
      throw new CreateException($this->t('Directory @path could not be created.', [
        '@path' => $directory,
      ]));
    }

    $file_name = "{$serie_directory_config}_{$this->entity->getEntityTypeId()}_{$this->entity->id()}.rdf";

    $content = '';
    foreach ($template as $item) {
      if (!empty($item['value'])) {
        $content .= $item['attribute'] . ': ' . $item['value'] . "\n";
      }
    }

    if (!file_put_contents("$directory/$file_name", $content)) {
      throw new CreateException($this->t('File @file_name could not be created.', [
        '@file_name' => $file_name,
      ]));
    }
  }

}