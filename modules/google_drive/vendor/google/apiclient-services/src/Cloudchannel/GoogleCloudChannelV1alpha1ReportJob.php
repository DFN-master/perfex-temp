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

namespace Google\Service\Cloudchannel;

class GoogleCloudChannelV1alpha1ReportJob extends \Google\Model
{
  /**
   * @var string
   */
  public $name;
  protected $reportStatusType = GoogleCloudChannelV1alpha1ReportStatus::class;
  protected $reportStatusDataType = '';

  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param GoogleCloudChannelV1alpha1ReportStatus
   */
  public function setReportStatus(GoogleCloudChannelV1alpha1ReportStatus $reportStatus)
  {
    $this->reportStatus = $reportStatus;
  }
  /**
   * @return GoogleCloudChannelV1alpha1ReportStatus
   */
  public function getReportStatus()
  {
    return $this->reportStatus;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudChannelV1alpha1ReportJob::class, 'Google_Service_Cloudchannel_GoogleCloudChannelV1alpha1ReportJob');
