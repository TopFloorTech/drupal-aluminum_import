<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 10:09 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


abstract class ConfigAdapterBase implements ConfigAdapterInterface {

  protected $adapterConfig = [];

  public function __construct(array $adapterConfig = []) {
    $this->adapterConfig = $adapterConfig + $this->adapterConfig;

    $this->loadConfig();
  }

  /**
   * Implementing classes should use this method to load the configuration into this object
   *
   * @return null
   */
  protected abstract function loadConfig();

  /**
   * {@inheritdoc}
   */
  public abstract function getValue($key, $default = NULL);
}
