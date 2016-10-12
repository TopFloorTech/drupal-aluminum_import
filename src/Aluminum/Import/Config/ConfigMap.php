<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 3:58 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


use Drupal\aluminum_storage\Aluminum\Config\ConfigInterface;

class ConfigMap implements ConfigMapInterface {

  /** @var ConfigInterface */
  protected $sourceConfig;

  /** @var array */
  protected $fieldMap;

  /**
   * BaseConfigMap constructor.
   *
   * @param \Drupal\aluminum_storage\Aluminum\Config\ConfigInterface $sourceConfig
   * @param array $fieldMap
   */
  public function __construct(ConfigInterface $sourceConfig, array $fieldMap = []) {
    $this->sourceConfig = $sourceConfig;
    $this->fieldMap = (array) $fieldMap;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldMap() {
    return $this->fieldMap;
  }

  /**
   * {@inheritdoc}
   */
  public function setFieldMap(array $fieldMap) {
    $this->fieldMap = $fieldMap;
  }

  /**
   * {@inheritdoc}
   */
  public function mergeConfig(array &$config) {
    foreach ($this->fieldMap as $configKey => $sourceConfigKey) {
      if (!isset($config[$configKey])) {
        $group = 'defaults';

        if (strpos($sourceConfigKey, '.') !== FALSE) {
          $parts = explode('.', $sourceConfigKey);

          $group = $parts[0];
          $sourceConfigKey = array_pop($parts);
        }

        $config[$configKey] = $this->sourceConfig
          ->getValue($sourceConfigKey, $group);
      }
    }
  }
}
