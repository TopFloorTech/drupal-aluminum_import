<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/4/2016
 * Time: 5:19 PM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;

use Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapter\AluminumStorageConfigAdapter;
use Drupal\aluminum_import\Aluminum\Import\Config\ConfigMap;
use Drupal\aluminum_import\Aluminum\Import\Config\ConfigValidator\RequiredFieldsConfigValidator;
use Drupal\aluminum_import\Aluminum\Import\Config\SourceConfig;
use Drupal\aluminum_import\Aluminum\Import\Config\SourceConfigInterface;
use Drupal\aluminum_storage\Aluminum\Config\ConfigManager;
use Drupal\migrate\MigrateException;
use Drupal\Migrate\Plugin\MigrationInterface;
use Drupal\migrate_source_csv\CSVFileObject;
use Drupal\migrate_source_csv\Plugin\migrate\source\CSV;

/**
 * Class AluminumImportCsv
 * @package Drupal\aluminum_import\Plugin\migrate\source
 *
 * @MigrateSource(
 *   id = "aluminum_import_csv"
 * )
 */
class AluminumImportCsv extends CSV {
  /** @var SourceConfigInterface */
  protected $sourceConfig;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $pluginId, $pluginDefinition, MigrationInterface $migration) {
    parent::__construct($this->prepareConfig($configuration), $pluginId, $pluginDefinition, $migration);
  }

  protected function &prepareConfig(array &$configuration, $fieldMap = [], $requiredFields = []) {
    $fieldMap += [
      'header_row_count' => 'csv_header_rows',
    ];

    $requiredFields += [
      'header_row_count' => 'Header row count',
    ];

    $configMap = new ConfigMap(ConfigManager::getConfig('admin'), $fieldMap);
    $validator = new RequiredFieldsConfigValidator($requiredFields);
    $configAdapter = new AluminumStorageConfigAdapter([
      'configId' => 'content_import',
      'groupId' => 'defaults',
    ]);

    $this->sourceConfig = new SourceConfig($configuration, $configAdapter, $configMap, $validator);

    $this->sourceConfig->mergeConfig();

    if (!$this->sourceConfig->validateConfig()) {
      throw new MigrateException($this->sourceConfig->getValidationErrorString());
    }

    return $this->sourceConfig->getConfig();
  }

  protected function getConfigValue($key, $default = NULL) {
    return $this->sourceConfig->getValue($key, $default);
  }

  /**
   * {@inheritdoc}
   *
   * Exclude CSVFileObject::DROP_NEW_LINE to keep multi-line values in tact
   */
  public function initializeIterator() {
    $file = parent::initializeIterator();

    $flags = CSVFileObject::READ_CSV |
      CSVFileObject::READ_AHEAD |
      CSVFileObject::SKIP_EMPTY;

    if (!$this->getConfigValue('preserve_multiline_values', FALSE)) {
      $flags |= CSVFileObject::DROP_NEW_LINE;
    }

    $file->setFlags($flags);
  }
}
