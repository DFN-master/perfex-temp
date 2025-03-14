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

namespace Google\Service\ChromeManagement;

class GoogleChromeManagementV1UserPrintReport extends \Google\Model
{
  /**
   * @var string
   */
  public $deviceCount;
  /**
   * @var string
   */
  public $jobCount;
  /**
   * @var string
   */
  public $printerCount;
  /**
   * @var string
   */
  public $userEmail;
  /**
   * @var string
   */
  public $userId;

  /**
   * @param string
   */
  public function setDeviceCount($deviceCount)
  {
    $this->deviceCount = $deviceCount;
  }
  /**
   * @return string
   */
  public function getDeviceCount()
  {
    return $this->deviceCount;
  }
  /**
   * @param string
   */
  public function setJobCount($jobCount)
  {
    $this->jobCount = $jobCount;
  }
  /**
   * @return string
   */
  public function getJobCount()
  {
    return $this->jobCount;
  }
  /**
   * @param string
   */
  public function setPrinterCount($printerCount)
  {
    $this->printerCount = $printerCount;
  }
  /**
   * @return string
   */
  public function getPrinterCount()
  {
    return $this->printerCount;
  }
  /**
   * @param string
   */
  public function setUserEmail($userEmail)
  {
    $this->userEmail = $userEmail;
  }
  /**
   * @return string
   */
  public function getUserEmail()
  {
    return $this->userEmail;
  }
  /**
   * @param string
   */
  public function setUserId($userId)
  {
    $this->userId = $userId;
  }
  /**
   * @return string
   */
  public function getUserId()
  {
    return $this->userId;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleChromeManagementV1UserPrintReport::class, 'Google_Service_ChromeManagement_GoogleChromeManagementV1UserPrintReport');
