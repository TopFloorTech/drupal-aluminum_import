<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 10:09 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


interface ConfigAdapterInterface {
  /**
   * Gets a value from the config referenced by this object.
   *
   * @param string $key The config key to look up
   * @param mixed $default A default to provide if none is found in the config
   * @return mixed The value from the config, falling back to the default value
   */
  public function getValue($key, $default = NULL);
}
