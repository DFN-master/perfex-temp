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

namespace Google\Service\GKEOnPrem;

class BareMetalLvpShareConfig extends \Google\Model
{
  protected $lvpConfigType = BareMetalLvpConfig::class;
  protected $lvpConfigDataType = '';
  /**
   * @var int
   */
  public $sharedPathPvCount;

  /**
   * @param BareMetalLvpConfig
   */
  public function setLvpConfig(BareMetalLvpConfig $lvpConfig)
  {
    $this->lvpConfig = $lvpConfig;
  }
  /**
   * @return BareMetalLvpConfig
   */
  public function getLvpConfig()
  {
    return $this->lvpConfig;
  }
  /**
   * @param int
   */
  public function setSharedPathPvCount($sharedPathPvCount)
  {
    $this->sharedPathPvCount = $sharedPathPvCount;
  }
  /**
   * @return int
   */
  public function getSharedPathPvCount()
  {
    return $this->sharedPathPvCount;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BareMetalLvpShareConfig::class, 'Google_Service_GKEOnPrem_BareMetalLvpShareConfig');
