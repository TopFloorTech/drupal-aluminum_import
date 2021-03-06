<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/12/2016
 * Time: 1:22 PM
 */

namespace Drupal\aluminum_import\Event;


abstract class ProductVariationLookupRowMigrateEvent extends ReferenceLookupRowMigrateEvent  {

  /**
   * Returns the entity type of this event
   *
   * @return string
   */
  protected function getEntityType() {
    return "commerce_product_variation";
  }

  /**
   * Returns the property of this entity type which holds the bundle ID
   *
   * @return string
   */
  protected function getBundleProperty() {
    return "type";
  }

  protected function getNameProperty() {
    return "sku";
  }
}
