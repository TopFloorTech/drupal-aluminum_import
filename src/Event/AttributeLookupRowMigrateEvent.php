<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/12/2016
 * Time: 1:22 PM
 */

namespace Drupal\aluminum_import\Event;


abstract class AttributeLookupRowMigrateEvent extends ReferenceLookupRowMigrateEvent  {

  /**
   * {@inheritdoc}
   */
  protected function getEntityType() {
    return "commerce_product_attribute_value";
  }

  /**
   * {@inheritdoc}
   */
  protected function getDelimiter() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  protected function getBundleProperty() {
    return "attribute";
  }
}
