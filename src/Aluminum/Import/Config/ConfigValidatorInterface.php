<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 4:08 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


interface ConfigValidatorInterface {

  /**
   * Validates the config array against this object's validation rules.
   *
   * @param array $config
   * @return bool TRUE if valid, FALSE otherwise
   */
  public function validate(array $config);

  /**
   * Returns any validation errors caught by this validator.
   *
   * @return array
   */
  public function getValidationErrors();

  /**
   * Clears any existing validation errors in this object.
   *
   * @return null
   */
  public function resetValidationErrors();

  /**
   * Gets a human-readable string for any errors currently registered in this validator.
   *
   * @return string
   */
  public function getErrorString();
}
