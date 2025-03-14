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

namespace Google\Service\CloudComposer;

class ExecuteAirflowCommandResponse extends \Google\Model
{
  /**
   * @var string
   */
  public $error;
  /**
   * @var string
   */
  public $executionId;
  /**
   * @var string
   */
  public $pod;
  /**
   * @var string
   */
  public $podNamespace;

  /**
   * @param string
   */
  public function setError($error)
  {
    $this->error = $error;
  }
  /**
   * @return string
   */
  public function getError()
  {
    return $this->error;
  }
  /**
   * @param string
   */
  public function setExecutionId($executionId)
  {
    $this->executionId = $executionId;
  }
  /**
   * @return string
   */
  public function getExecutionId()
  {
    return $this->executionId;
  }
  /**
   * @param string
   */
  public function setPod($pod)
  {
    $this->pod = $pod;
  }
  /**
   * @return string
   */
  public function getPod()
  {
    return $this->pod;
  }
  /**
   * @param string
   */
  public function setPodNamespace($podNamespace)
  {
    $this->podNamespace = $podNamespace;
  }
  /**
   * @return string
   */
  public function getPodNamespace()
  {
    return $this->podNamespace;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ExecuteAirflowCommandResponse::class, 'Google_Service_CloudComposer_ExecuteAirflowCommandResponse');
