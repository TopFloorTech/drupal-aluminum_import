<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/11/2016
 * Time: 12:49 AM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;


class AluminumImportCsvContent extends AluminumImportCsv {
  protected function prepareConfig(array $configuration, $fieldMap = [], $requiredFields = []) {
    $fieldMap += [
      'path' => $configuration['path_option'],
    ];

    $requiredFields += [
      'path' => 'Path',
    ];

    return parent::prepareConfig($configuration, $fieldMap, $requiredFields);
  }
}
