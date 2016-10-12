<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/4/2016
 * Time: 5:19 PM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;

/**
 * Class AluminumImportCsvImageField
 * @package Drupal\aluminum_import\Plugin\migrate\source
 *
 * @MigrateSource(
 *   id = "aluminum_import_csv_image_field"
 * )
 */
class AluminumImportCsvImageField extends AluminumImportCsvFileField {
  protected function &prepareConfig(array &$configuration, $fieldMap = [], $requiredFields = []) {
    $fieldMap += [
      'source_image_dir' => 'source_image_dir',
      'destination_image_dir' => 'destination_image_dir',
    ];

    return parent::prepareConfig($configuration, $fieldMap, $requiredFields);
  }

  protected function getFileBaseUri($type = 'source') {
    $path = parent::getFileBaseUri($type);

    $imageDir = $this->configuration[$type . "_image_dir"];
    if (!empty($imageDir)) {
      $path .= "$imageDir/";
    }

    return $path;
  }
}
