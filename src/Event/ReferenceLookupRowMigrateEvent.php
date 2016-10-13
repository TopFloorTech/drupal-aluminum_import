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
   * Returns the vocabulary ID that should be matched against
   *
   * @return string
   */
  protected abstract function getBundleId();

  /**
   * Get the ID of the term reference source property
   *
   * @return mixed
   */
  protected abstract function getReferenceField();

  /**
   * attempts to load and return a valid entity for the provided name
   *
   * @param string $name
   * @param \Drupal\migrate_plus\Event\MigratePrepareRowEvent $event
   * @return int|null
   */
  protected abstract function getEntityId($name, MigratePrepareRowEvent $event);

  /**
   * {@inheritdoc}
   */
  public function onPrepareRow(MigratePrepareRowEvent $event) {
    $referenceField = $this->getReferenceField();

    $row = $event->getRow();

    $name = $row->getSourceProperty($referenceField);

    $newValue = NULL;

    if (is_numeric($name)) {
      $newValue = $name;
    } elseif (!empty($name)) {
      $newValue = $this->getEntityId($name, $event);
    }

    $row->setSourceProperty($referenceField, $newValue);
  }
}
