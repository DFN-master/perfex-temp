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

class GrpcRouteFaultInjectionPolicyAbort extends \Google\Model
{
  /**
   * @var int
   */
  public $httpStatus;
  /**
   * @var int
   */
  public $percentage;

  /**
   * @param int
   */
  public function setHttpStatus($httpStatus)
  {
    $this->httpStatus = $httpStatus;
  }
  /**
   * @return int
   */
  public function getHttpStatus()
  {
    return $this->httpStatus;
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
class_alias(GrpcRouteFaultInjectionPolicyAbort::class, 'Google_Service_NetworkServices_GrpcRouteFaultInjectionPolicyAbort');
