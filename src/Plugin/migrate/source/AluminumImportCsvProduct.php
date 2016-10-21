<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/17/2016
 * Time: 2:25 PM
 */

namespace Drupal\aluminum_import\Plugin\migrate\source;


use Drupal\migrate\Row;

/**
 * Class AluminumImportCsvProduct
 * @package Drupal\aluminum_import\Plugin\migrate\source
 *
 * @MigrateSource(
 *   id = "aluminum_import_csv_product"
 * )
 */
class AluminumImportCsvProduct extends AluminumImportCsvContent {
  public function prepareRow(Row $row) {
    if (!parent::prepareRow($row)) {
      return FALSE;
    }

    $targets = [];

    $query = \Drupal::entityQuery('commerce_product_variation')
      ->condition('field_base_sku', $row->getSourceProperty('field_base_sku'));

    $values = $query->execute();

    foreach ($values as $value) {
      $targets[] = ['target_id' => $value];
    }

    $row->setDestinationProperty('variations', $targets);

    $row->rehash();

    return TRUE;
  }
}
