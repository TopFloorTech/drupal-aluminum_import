<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 4:14 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


abstract class ConfigValidatorBase implements ConfigValidatorInterface {

  protected $validationErrors = [];

  /**
   * {@inheritdoc}
   */
  public abstract function validate(array $config);

  /**
   * {@inheritdoc}
   */
  public function getValidationErrors() {
    return $this->validationErrors;
  }

  /**
   * {@inheritdoc}
   */
  public function resetValidationErrors() {
    $this->validationErrors = [];
  }

  /**
   * {@inheritdoc}
   */
  public function getErrorString() {
    return implode("\n", $this->validationErrors);
  }
}
