<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/13/2016
 * Time: 12:03 AM
 */

namespace Drupal\aluminum_import\Plugin\migrate\process;


use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

class AluminumExplode extends ProcessPluginBase  {
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $result = explode($this->configuration['delimiter'], $value);

    return $result;
  }
}
