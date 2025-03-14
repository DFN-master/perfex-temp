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

namespace Google\Service\Firestore;

class GoogleFirestoreAdminV1CmekConfig extends \Google\Collection
{
  protected $collection_key = 'activeKeyVersion';
  /**
   * @var string[]
   */
  public $activeKeyVersion;
  /**
   * @var string
   */
  public $kmsKeyName;

  /**
   * @param string[]
   */
  public function setActiveKeyVersion($activeKeyVersion)
  {
    $this->activeKeyVersion = $activeKeyVersion;
  }
  /**
   * @return string[]
   */
  public function getActiveKeyVersion()
  {
    return $this->activeKeyVersion;
  }
  /**
   * @param string
   */
  public function setKmsKeyName($kmsKeyName)
  {
    $this->kmsKeyName = $kmsKeyName;
  }
  /**
   * @return string
   */
  public function getKmsKeyName()
  {
    return $this->kmsKeyName;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleFirestoreAdminV1CmekConfig::class, 'Google_Service_Firestore_GoogleFirestoreAdminV1CmekConfig');
