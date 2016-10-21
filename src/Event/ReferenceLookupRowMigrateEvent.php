<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/12/2016
 * Time: 9:58 PM
 */

namespace Drupal\aluminum_import\Event;


use Drupal\migrate_plus\Event\MigratePrepareRowEvent;

abstract class ReferenceLookupRowMigrateEvent extends RowMigrateEvent {
  /**
   * Gets an array of reference fields to bundle IDs
   *
   * @return array
   */
  protected abstract function getReferenceFields();

  /**
   * Returns the entity type of this event
   *
   * @return string
   */
  protected abstract function getEntityType();

  /**
   * Returns the property of this entity type which holds the bundle ID
   *
   * @return string
   */
  protected abstract function getBundleProperty();

  /**
   * Returns the property of this entity type which holds the name
   *
   * @return string
   */
  protected function getNameProperty() {
    return "name";
  }

  /**
   * attempts to load and return a valid entity for the provided name
   *
   * @param string $name
   * @param string $bundle
   * @return int|null
   */
  protected function getEntityId($name, $bundle) {
    $entities = \Drupal::entityTypeManager()->getStorage($this->getEntityType())->loadByProperties([
      $this->getBundleProperty() => $bundle,
      $this->getNameProperty() => $name,
    ]);

    return (!empty($entities)) ? array_pop(array_keys($entities)) : NULL;
  }

  protected function getDelimiter() {
    return ", ";
  }

  protected function determineId($name, $bundleId) {
    $newValue = NULL;

    if (is_numeric($name)) {
      $newValue = $name;
    } elseif (!empty($name)) {
      $newValue = $this->getEntityId($name, $bundleId);
    }

    return !empty($newValue) ? $newValue : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function onPrepareRow(MigratePrepareRowEvent $event) {
    foreach ($this->getReferenceFields() as $referenceField => $bundleId) {
      $row = $event->getRow();
      $value = $row->getSourceProperty($referenceField);
      $delimiter = $this->getDelimiter();

      if ($delimiter) {
        $newValue = [];

        foreach (explode(", ", $value) as $name) {
          $newValue[] = ['target_id' => $this->determineId($name, $bundleId)];
        }
      } else {
        $newValue = ['target_id' => $this->determineId($value, $bundleId)];
      }

      $row->setSourceProperty($referenceField, $newValue);
    }
  }
}
