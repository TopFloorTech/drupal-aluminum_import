<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/10/2016
 * Time: 4:24 PM
 */

namespace Drupal\aluminum_import\Aluminum\Import\Config;


class RequiredFieldsConfigValidator extends ConfigValidatorBase {

  protected $requiredFields = [];

  public function __construct($requiredFields = []) {
    $this->requiredFields = $requiredFields + $this->requiredFields;
  }

  /**
   * Gets the current map of required fields as [$fieldId => $title]
   *
   * @return array
   */
  public function getRequiredFields() {
    return $this->requiredFields;
  }

  /**
   * Sets an array map of required field IDs to their human readable titles.
   *
   * @param array $requiredFields
   */
  public function setRequiredFields(array $requiredFields) {
    $this->requiredFields = $requiredFields;
  }

  /**
   * {@inheritdoc}
   */
  public function validate(array $config) {
    $success = TRUE;

    foreach ($this->requiredFields as $fieldId => $title) {
      if (empty($config[$fieldId])) {
        $this->validationErrors[$fieldId] = "You must declare the $title ($fieldId) option for this migration.";

        $success = FALSE;
      }
    }

    return $success;
  }
}
