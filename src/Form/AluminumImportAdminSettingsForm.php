<?php
/**
 * Created by PhpStorm.
 * User: BMcClure
 * Date: 10/9/2016
 * Time: 7:07 PM
 */

namespace Drupal\aluminum_import\Form;


use Drupal\aluminum_storage\Form\AluminumStorageSettingsForm;

class AluminumImportAdminSettingsForm extends AluminumStorageSettingsForm  {
  protected $configId = 'content_import';
}
