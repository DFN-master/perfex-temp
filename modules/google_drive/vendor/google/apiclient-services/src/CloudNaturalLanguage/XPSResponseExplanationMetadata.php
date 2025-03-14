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

namespace Google\Service\CloudNaturalLanguage;

class XPSResponseExplanationMetadata extends \Google\Model
{
  protected $inputsType = XPSResponseExplanationMetadataInputMetadata::class;
  protected $inputsDataType = 'map';
  protected $outputsType = XPSResponseExplanationMetadataOutputMetadata::class;
  protected $outputsDataType = 'map';

  /**
   * @param XPSResponseExplanationMetadataInputMetadata[]
   */
  public function setInputs($inputs)
  {
    $this->inputs = $inputs;
  }
  /**
   * @return XPSResponseExplanationMetadataInputMetadata[]
   */
  public function getInputs()
  {
    return $this->inputs;
  }
  /**
   * @param XPSResponseExplanationMetadataOutputMetadata[]
   */
  public function setOutputs($outputs)
  {
    $this->outputs = $outputs;
  }
  /**
   * @return XPSResponseExplanationMetadataOutputMetadata[]
   */
  public function getOutputs()
  {
    return $this->outputs;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(XPSResponseExplanationMetadata::class, 'Google_Service_CloudNaturalLanguage_XPSResponseExplanationMetadata');
