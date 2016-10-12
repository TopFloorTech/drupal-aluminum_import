<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/12/2016
 * Time: 1:22 PM
 */

namespace Drupal\aluminum_import\Event;


use Drupal\migrate_plus\Event\MigratePrepareRowEvent;

abstract class TermLookupRowMigrateEvent extends RowMigrateEvent {

  /**
   * Returns the vocabulary ID that should be matched against
   *
   * @return string
   */
  protected abstract function getVid();

  /**
   * Get the ID of the term reference source property
   *
   * @return mixed
   */
  protected abstract function getReferenceField();

  /**
   * {@inheritdoc}
   */
  public function onPrepareRow(MigratePrepareRowEvent $event) {
    $termReferenceField = $this->getReferenceField();

    $row = $event->getRow();

    $termName = $row->getSourceProperty($termReferenceField);

    $newValue = NULL;

    if (is_numeric($termName)) {
      $newValue = $termName;
    } elseif (!empty($termName)) {
      $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties([
        'vid' => $this->getVid(),
        'name' => $termName,
      ]);

      $newValue = (!empty($terms)) ? array_pop(array_keys($terms)) : NULL;
    }

    $row->setSourceProperty($termReferenceField, $newValue);
  }
}
