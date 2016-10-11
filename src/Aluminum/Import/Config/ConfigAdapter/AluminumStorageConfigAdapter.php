<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 10:11 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapter;


use Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapterBase;
use Drupal\aluminum_storage\Aluminum\Config\ConfigGroupInterface;
use Drupal\aluminum_storage\Aluminum\Config\ConfigManager;

class AluminumStorageConfigAdapter extends ConfigAdapterBase {

  /** @var ConfigGroupInterface */
  protected $config;

  protected $adapterConfig = [
    'configId' => 'content_import',
    'groupId' => 'defaults'
  ];

  /**
   * {@inheritdoc}
   */
  protected function loadConfig() {
    $this->config = ConfigManager::getConfig($this->adapterConfig['configId'])
      ->getConfigGroup($this->adapterConfig['groupId']);
  }

  /**
   * {@inheritdoc}
   */
  public function getValue($key, $default = NULL) {
    $item = $this->config->getConfigItem($key);

    if (!$item->hasValue() && !is_null($default)) {
      return $default;
    }

    return $item->getValue();
  }
}
