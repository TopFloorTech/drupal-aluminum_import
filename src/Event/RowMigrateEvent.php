<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 9/29/2016
 * Time: 12:45 AM
 */

namespace Drupal\aluminum_import\Event;


use Drupal\migrate_plus\Event\MigrateEvents;
use Drupal\migrate_plus\Event\MigratePrepareRowEvent;

abstract class RowMigrateEvent extends BaseMigrateEvent {
  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events = [];

    $events[MigrateEvents::PREPARE_ROW][] = ['onPrepareRow', 0];

    return $events;
  }

  /**
   * @param \Drupal\migrate_plus\Event\MigratePrepareRowEvent $event
   * @return mixed
   */
  public abstract function onPrepareRow(MigratePrepareRowEvent $event);
}
