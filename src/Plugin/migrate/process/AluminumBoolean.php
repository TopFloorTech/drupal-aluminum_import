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

/**
 * Class AluminumExplode
 * @package Drupal\aluminum_import\Plugin\migrate\process
 *
 * @MigrateProcessPlugin(
 *   id = "aluminum_boolean"
 * )
 */
class AluminumBoolean extends ProcessPluginBase  {
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $false = [
      false,
      "false",
      "0",
    ];

    return (in_array(strtolower($value), $false)) ? 0 : 1;
  }
}
