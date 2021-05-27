<?php

namespace Drupal\repec\Series;

use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\File\FileSystemInterface;

/**
 * Base structure for templating classes.
 */
abstract class Base implements BaseInterface {

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
   * Bundle specific setting in repec settings.
   *
   * @var array|null
   */
  protected $bundleSettings;

  /**
   * Drupal\Core\File\FileSystemInterface definition.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

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
   * @param array|null $bundle_settings
   *   Bundle specific setting in repec settings.
   * @param \Drupal\Core\File\FileSystemInterface $file_system
   *   File system service.
   */
  public function __construct(ImmutableConfig $settings, EntityTypeManagerInterface $entity_type_manager, MessengerInterface $messenger, ContentEntityInterface $entity, array $bundle_settings, FileSystemInterface $file_system) {
    $this->settings = $settings;
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
    $this->entity = $entity;
    $this->bundleSettings = $bundle_settings;
    $this->fileSystem = $file_system;
  }

  /**
   * {@inheritdoc}
   */
  public function getDefault() : array {
    // Get html title field and strip html tags.
    $title = strip_tags($this->entity->html_title->value);
    return [
      [
        'attribute' => 'Title',
        'value' => $title,
      ],
      [
        'attribute' => 'Number',
        // Entity id cannot be used here as there could be
        // probably several entity types in a further release.
        'value' => $this->entity->uuid(),
      ],
      [
        'attribute' => 'Handle',
        'value' => "RePEc:{$this->settings->get('archive_code')}:{$this->bundleSettings['serie_type']}:{$this->entity->id()}",
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function create(array $template) {
    /** @var string $serie_directory_config */
    $serie_directory_config = $this->bundleSettings['serie_directory'];

    $archive_directory = "public://{$this->settings->get('base_path')}/{$this->settings->get('archive_code')}/";

    $directory = "{$archive_directory}{$serie_directory_config}/";

    if (!$this->fileSystem->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY)) {
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
