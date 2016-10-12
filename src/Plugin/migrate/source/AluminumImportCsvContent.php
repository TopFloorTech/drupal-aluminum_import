<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/11/2016
 * Time: 12:49 AM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;
use Drupal\aluminum_import\Aluminum\Import\Config\ConfigAdapter\AluminumStorageConfigAdapter;
use Drupal\system_test\Controller\PageCacheAcceptHeaderController;

/**
 * Class AluminumImportCsvContent
 * @package Drupal\aluminum_import\Plugin\migrate\source
 *
 * @MigrateSource(
 *   id = "aluminum_import_csv_content"
 * )
 */
class AluminumImportCsvContent extends AluminumImportCsv {
  protected function &prepareConfig(array &$configuration, $fieldMap = [], $requiredFields = []) {
    $requiredFields += [
      'path' => 'Path',
    ];

    $configuration['path'] = $this->getPath($configuration);

    $config = parent::prepareConfig($configuration, $fieldMap, $requiredFields);

    return $config;
  }

  protected function getTemporaryFile($configPath, $localPath) {
    if (file_exists($localPath)) {
      $mtime = filemtime($localPath);

      $fiveMinutesAgo = strtotime('-5 minutes');

      if ($mtime > $fiveMinutesAgo) {
        return $localPath;
      }
    }

    $contents = file_get_contents($configPath);

    $dir = dirname($localPath);
    if (!file_exists($dir)) {
      \Drupal::service('file_system')->mkdir($dir, NULL, TRUE);
    }

    $configPath = file_unmanaged_save_data($contents, $localPath, FILE_EXISTS_REPLACE);

    return $configPath;
  }

  protected function getPath(array $configuration) {
    $configAdapter = new AluminumStorageConfigAdapter(['groupId' => 'sources']);

    $configPath = $configAdapter->getValue($configuration['path_option']);

    $localPath = $configAdapter->getValue($configuration['local_path_option']);

    $scheme = parse_url($configPath, PHP_URL_SCHEME);

    if (!in_array($scheme, ['public', 'private'])) {
      $configPath = $this->getTemporaryFile($configPath, $localPath);
    }

    return $configPath;
  }
}
