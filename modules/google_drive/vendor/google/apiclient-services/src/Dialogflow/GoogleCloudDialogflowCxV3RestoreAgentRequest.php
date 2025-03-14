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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowCxV3RestoreAgentRequest extends \Google\Model
{
  /**
   * @var string
   */
  public $agentContent;
  /**
   * @var string
   */
  public $agentUri;
  protected $gitSourceType = GoogleCloudDialogflowCxV3RestoreAgentRequestGitSource::class;
  protected $gitSourceDataType = '';
  /**
   * @var string
   */
  public $restoreOption;

  /**
   * @param string
   */
  public function setAgentContent($agentContent)
  {
    $this->agentContent = $agentContent;
  }
  /**
   * @return string
   */
  public function getAgentContent()
  {
    return $this->agentContent;
  }
  /**
   * @param string
   */
  public function setAgentUri($agentUri)
  {
    $this->agentUri = $agentUri;
  }
  /**
   * @return string
   */
  public function getAgentUri()
  {
    return $this->agentUri;
  }
  /**
   * @param GoogleCloudDialogflowCxV3RestoreAgentRequestGitSource
   */
  public function setGitSource(GoogleCloudDialogflowCxV3RestoreAgentRequestGitSource $gitSource)
  {
    $this->gitSource = $gitSource;
  }
  /**
   * @return GoogleCloudDialogflowCxV3RestoreAgentRequestGitSource
   */
  public function getGitSource()
  {
    return $this->gitSource;
  }
  /**
   * @param string
   */
  public function setRestoreOption($restoreOption)
  {
    $this->restoreOption = $restoreOption;
  }
  /**
   * @return string
   */
  public function getRestoreOption()
  {
    return $this->restoreOption;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3RestoreAgentRequest::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3RestoreAgentRequest');
