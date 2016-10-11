<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 10:43 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


class ConfigValidatorCollection implements \Iterator {

  /** @var array */
  protected $validators;

  protected $position = 0;

  /**
   * ConfigValidatorCollection constructor.
   *
   * @param array $validators
   */
  public function __construct(array $validators = []) {
    $this->validators = $validators;
  }

  /**
   * {@inheritdoc}
   */
  public function current() {
    return current($this->validators);
  }

  /**
   * {@inheritdoc}
   */
  public function next() {
    return next($this->validators);
  }

  /**
   * {@inheritdoc}
   */
  public function key() {
    return key($this->validators);
  }

  /**
   * {@inheritdoc}
   */
  public function valid() {
    return key($this->validators) !== null;
  }

  /**
   * {@inheritdoc}
   */
  public function rewind() {
    reset($this->validators);
  }

  public function set($id, ConfigValidatorInterface $validator) {
    $this->validators[$id] = $validator;
  }

  public function get($id) {
    if (isset($this->validators[$id])) {
      return $this->validators[$id];
    }

    return NULL;
  }

  public function remove($id) {
    unset($this->validators[$id]);
  }

  public function validate(array $config) {
    $success = TRUE;

    /** @var ConfigValidatorInterface $validator */
    foreach ($this as $validator) {
      if (!$validator->validate($config)) {
        $success = FALSE;
      }
    }

    return $success;
  }

  public function getValidationErrors() {
    $errors = [];

    /** @var ConfigValidatorInterface $validator */
    foreach ($this as $validator) {
      foreach ($validator->getValidationErrors() as $fieldId => $validationError) {
        $errors[$fieldId][] = $validationError;
      }
    }

    return $errors;
  }

  public function getValidationErrorString() {
    $errorStrings = [];

    /** @var ConfigValidatorInterface $validator */
    foreach ($this as $validator) {
      $errorString = $validator->getErrorString();

      if (!empty($errorString)) {
        $errorStrings[] = $errorString;
      }
    }

    return implode("\n", $errorStrings);
  }

  public function resetValidationErrors() {
    /** @var ConfigValidatorInterface $validator */
    foreach ($this as $validator) {
      $validator->resetValidationErrors();
    }
  }
}
