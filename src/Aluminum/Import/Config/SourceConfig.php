<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 9:26 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


class SourceConfig implements SourceConfigInterface {
  protected $config;

  protected $configMap;

  protected $configAdapter;

  protected $validators;

  /**
   * BaseSourceConfig constructor.
   *
   * @param array $config
   * @param \Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapterInterface $configAdapter
   * @param \Drupal\aluminum_import\Aluminum\Import\Config\ConfigMapInterface $configMap
   * @param array $validators
   */
  public function __construct(array &$config, ConfigAdapterInterface $configAdapter, ConfigMapInterface $configMap, $validators = []) {
    $this->config =& $config;
    $this->configAdapter = $configAdapter;
    $this->configMap = $configMap;

    $this->validators = new ConfigValidatorCollection((array) $validators);
  }

  /**
   * {@inheritdoc}
   */
  public function getValue($key, $default = NULL) {
    return $this->getConfigAdapter()->getValue($key, $default);
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigMap() {
    return $this->configMap;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfigMap(ConfigMapInterface $configMap) {
    $this->configMap = $configMap;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigAdapter() {
    return $this->configAdapter;
  }

  /**
   * {@inheritdoc}
   */
  public function setConfigAdapter(ConfigAdapterInterface $configAdapter) {
    $this->configAdapter = $configAdapter;
  }

  /**
   * {@inheritdoc}
   */
  public function getValidators() {
    return $this->validators;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfig() {
    return $this->validators->validate($this->config);
  }

  /**
   * {@inheritdoc}
   */
  public function getValidationErrors() {
    return $this->validators->getValidationErrors();
  }

  /**
   * {@inheritdoc}
   */
  public function getValidationErrorString() {
    return $this->validators->getValidationErrorString();
  }

  /**
   * {@inheritdoc}
   */
  public function mergeConfig() {
    $this->configMap->mergeConfig($this->config);
  }

  /**
   * {@inheritdoc}
   */
  public function &getConfig() {
    return $this->config;
  }
}
