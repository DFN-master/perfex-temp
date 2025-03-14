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

namespace Google\Service\NetworkServices;

class HttpRouteFaultInjectionPolicyDelay extends \Google\Model
{
  /**
   * @var string
   */
  public $fixedDelay;
  /**
   * @var int
   */
  public $percentage;

  /**
   * @param string
   */
  public function setFixedDelay($fixedDelay)
  {
    $this->fixedDelay = $fixedDelay;
  }
  /**
   * @return string
   */
  public function getFixedDelay()
  {
    return $this->fixedDelay;
  }
  /**
   * @param int
   */
  public function setPercentage($percentage)
  {
    $this->percentage = $percentage;
  }
  /**
   * @return int
   */
  public function getPercentage()
  {
    return $this->percentage;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HttpRouteFaultInjectionPolicyDelay::class, 'Google_Service_NetworkServices_HttpRouteFaultInjectionPolicyDelay');
