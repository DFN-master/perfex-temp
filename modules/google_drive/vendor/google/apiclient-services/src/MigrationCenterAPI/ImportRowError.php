<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\MigrationCenterAPI;

class ImportRowError extends \Google\Collection
{
  protected $collection_key = 'errors';
  protected $errorsType = ImportError::class;
  protected $errorsDataType = 'array';
  /**
   * @var int
   */
  public $rowNumber;
  /**
   * @var string
   */
  public $vmName;
  /**
   * @var string
   */
  public $vmUuid;

  /**
   * @param ImportError[]
   */
  public function setErrors($errors)
  {
    $this->errors = $errors;
  }
  /**
   * @return ImportError[]
   */
  public function getErrors()
  {
    return $this->errors;
  }
  /**
   * @param int
   */
  public function setRowNumber($rowNumber)
  {
    $this->rowNumber = $rowNumber;
  }
  /**
   * @return int
   */
  public function getRowNumber()
  {
    return $this->rowNumber;
  }
  /**
   * @param string
   */
  public function setVmName($vmName)
  {
    $this->vmName = $vmName;
  }
  /**
   * @return string
   */
  public function getVmName()
  {
    return $this->vmName;
  }
  /**
   * @param string
   */
  public function setVmUuid($vmUuid)
  {
    $this->vmUuid = $vmUuid;
  }
  /**
   * @return string
   */
  public function getVmUuid()
  {
    return $this->vmUuid;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ImportRowError::class, 'Google_Service_MigrationCenterAPI_ImportRowError');
