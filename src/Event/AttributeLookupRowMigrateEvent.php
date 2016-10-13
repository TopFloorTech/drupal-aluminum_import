<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/12/2016
 * Time: 1:22 PM
 */

namespace Drupal\aluminum_import\Event;


use Drupal\migrate_plus\Event\MigratePrepareRowEvent;

abstract class AttributeLookupRowMigrateEvent extends ReferenceLookupRowMigrateEvent  {
  /**
   * attempts to load and return a valid entity for the provided name
   *
   * @param string $name
   * @param \Drupal\migrate_plus\Event\MigratePrepareRowEvent $event
   * @return int|null
   */
  protected function getEntityId($name, MigratePrepareRowEvent $event) {
    $entities = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties([
      'attribute' => $this->getBundleId(),
      'name' => $name,
    ]);

    $newValue = (!empty($entities)) ? array_pop(array_keys($entities)) : NULL;

    return $newValue;
  }
}
