<?php

/**
 * @file
 * RePEc module hooks.
 */

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Maps the series fields with the entity fields to generate the template file.
 *
 * @param \Drupal\Core\Entity\ContentEntityInterface $entity
 *   The entity that is the subject of the mapping.
 *
 * @ingroup repec
 */
function hook_repec_paper_mapping(ContentEntityInterface $entity) {
}

/**
 * Defines hook_repec_paper_mapping_alter().
 *
 * @param array $data
 *   Todo description.
 *
 * @ingroup repec
 */
function hook_repec_paper_mapping_alter(array &$data) {
}

/**
 * Maps the series attributes with the settings.
 *
 * Generates the series template file.
 *
 * Todo review description.
 *
 * @ingroup repec
 */
function hook_repec_series_mapping() {
}

/**
 * Defines hook_repec_series_mapping_alter().
 *
 * @param array $data
 *   Todo description.
 *
 * @ingroup repec
 */
function hook_repec_series_mapping_alter(array &$data) {
}

/**
 * Defines hook_repec_series_mapping_alter().
 *
 * @ingroup repec
 */
function hook_repec_archive_mapping() {
}

/**
 * Defines hook_repec_archive_mapping_alter().
 *
 * @param array $data
 *   Todo description.
 *
 * @ingroup repec
 */
function hook_repec_archive_mapping_alter(array &$data) {
}

/**
 * Alters the template.
 *
 * @param array $data
 *   The template to be altered.
 * @param \Drupal\Core\Entity\ContentEntityInterface $entity
 *   The content entity to be used for altering the template.
 *
 * @ingroup repec
 */
function hook_repec_template_alter(array &$data, ContentEntityInterface $entity) {
}

/**
 * Alters the template for a specific series.
 *
 * @param array $data
 *   The template to be altered.
 * @param \Drupal\Core\Entity\ContentEntityInterface $entity
 *   The content entity to be used for altering the template.
 *
 * @ingroup repec
 */
function hook_repec_template_SERIES_alter(array &$data, ContentEntityInterface $entity) {
}

/**
 * @} End of "addtogroup hooks".
 */
