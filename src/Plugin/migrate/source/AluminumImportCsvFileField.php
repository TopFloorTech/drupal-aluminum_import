<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/4/2016
 * Time: 5:19 PM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;

use Drupal\migrate\Row;

class AluminumImportCsvFileField extends AluminumImportCsv {
  protected function prepareConfig(array $configuration, $fieldMap = [], $requiredFields = []) {
    $fieldMap += [
      'source_file_scheme' => 'source_file_scheme',
      'source_file_path' => 'source_file_path',
      'destination_file_scheme' => 'destination_file_scheme',
      'destination_file_path' => 'destination_file_path',
    ];

    $requiredFields += [
      'source_file_scheme' => 'Source file scheme',
      'destination_file_scheme' => 'Destination file scheme',
    ];

    return parent::prepareConfig($configuration, $fieldMap, $requiredFields);
  }

  protected function getFileBaseUri($type = 'source') {
    $path = $this->configuration[$type . "_file_scheme"];

    $filePath = $this->configuration[$type . "_file_path"];
    if (!empty($filePath)) {
      $path .= "$filePath/";
    }

    return $path;
  }

  protected function getFileUri(Row $row, $type = 'source') {
    $path = $this->getFileBaseUri($type);

    $path .= $row->getSourceProperty($this->configuration['file_column']);

    return $path;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    $row->setSourceProperty($this->configuration['file_column'] . '_source', $this->getFileUri($row, 'source'));
    $row->setSourceProperty($this->configuration['file_column'] . '_destination', $this->getFileUri($row, 'destination'));
  }
}