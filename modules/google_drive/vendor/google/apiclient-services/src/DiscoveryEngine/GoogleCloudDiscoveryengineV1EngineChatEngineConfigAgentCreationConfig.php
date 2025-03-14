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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1EngineChatEngineConfigAgentCreationConfig extends \Google\Model
{
  /**
   * @var string
   */
  public $business;
  /**
   * @var string
   */
  public $defaultLanguageCode;
  /**
   * @var string
   */
  public $location;
  /**
   * @var string
   */
  public $timeZone;

  /**
   * @param string
   */
  public function setBusiness($business)
  {
    $this->business = $business;
  }
  /**
   * @return string
   */
  public function getBusiness()
  {
    return $this->business;
  }
  /**
   * @param string
   */
  public function setDefaultLanguageCode($defaultLanguageCode)
  {
    $this->defaultLanguageCode = $defaultLanguageCode;
  }
  /**
   * @return string
   */
  public function getDefaultLanguageCode()
  {
    return $this->defaultLanguageCode;
  }
  /**
   * @param string
   */
  public function setLocation($location)
  {
    $this->location = $location;
  }
  /**
   * @return string
   */
  public function getLocation()
  {
    return $this->location;
  }
  /**
   * @param string
   */
  public function setTimeZone($timeZone)
  {
    $this->timeZone = $timeZone;
  }
  /**
   * @return string
   */
  public function getTimeZone()
  {
    return $this->timeZone;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1EngineChatEngineConfigAgentCreationConfig::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1EngineChatEngineConfigAgentCreationConfig');
