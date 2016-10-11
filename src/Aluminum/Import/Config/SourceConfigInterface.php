<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 8:28 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


interface SourceConfigInterface {

  /**
   * Gets a value from the config adapter in this object
   *
   * @param string $key The config key to look up
   * @param mixed $default A default to provide if none is found in the config
   * @return mixed The value from the config, falling back to the default value
   */
  public function getValue($key, $default = NULL);

  /**
   * Returns the current ConfigMapInterface object associated with this config.
   *
   * @return ConfigMapInterface
   */
  public function getConfigMap();

  /**
   * Sets a new ConfigMapInterface object into this config to replace the existing one.
   *
   * @param \Drupal\aluminum_import\Aluminum\Import\Config\ConfigMapInterface $configMap
   * @return null
   */
  public function setConfigMap(ConfigMapInterface $configMap);

  /**
   * Gets the ConfigAdapterInterface object for this config.
   *
   * @return ConfigAdapterInterface
   */
  public function getConfigAdapter();

  /**
   * Sets the config adapter for this config.
   *
   * @param \Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapterInterface $configAdapter
   * @return null
   */
  public function setConfigAdapter(ConfigAdapterInterface $configAdapter);

  /**
   * Returns an array of all currently registered validators
   *
   * @return ConfigValidatorInterface[]
   */
  public function getValidators();

  /**
   * Run all validators and return an aggregate result
   *
   * @return TRUE if all validators succeeded, FALSE otherwise
   */
  public function validateConfig();

  /**
   * Get all validation errors from all validators.
   *
   * @return array
   */
  public function getValidationErrors();

  /**
   * Get all validation errors as a single string.
   *
   * @return string
   */
  public function getValidationErrorString();

  /**
   * Merges the config adapter's config into this source config object, only
   * writing values that haven't already been set by the source config.
   *
   * Modifies the source config in place.
   *
   * @return null
   */
  public function mergeConfig();

  /**
   * Returns the current config array
   *
   * @return array
   */
  public function &getConfig();
}
