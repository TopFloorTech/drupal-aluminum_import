<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 3:30 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;

/**
 * Interface ConfigMap
 *
 * Maps site or other configuration to import configuration and merges the two.
 *
 * @package Drupal\aluminum_import\Aluminum\Import\Config
 */
interface ConfigMapInterface {
  /**
   * Returns the current field map.
   *
   * @return array
   */
  public function getFieldMap();

  /**
   * Sets the current field map to the provided array.
   *
   * @param array $fieldMap
   * @return null
   */
  public function setFieldMap(array $fieldMap);

  /**
   * Merges the config into the provided config according to the field map
   *
   * @param array $config
   * @return bool TRUE if config merged successfully, FALSE otherwise
   */
  public function mergeConfig(array &$config);
}
