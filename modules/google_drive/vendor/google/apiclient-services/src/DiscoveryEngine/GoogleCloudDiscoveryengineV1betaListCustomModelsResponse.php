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

class GoogleCloudDiscoveryengineV1betaListCustomModelsResponse extends \Google\Collection
{
  protected $collection_key = 'models';
  protected $modelsType = GoogleCloudDiscoveryengineV1betaCustomTuningModel::class;
  protected $modelsDataType = 'array';

  /**
   * @param GoogleCloudDiscoveryengineV1betaCustomTuningModel[]
   */
  public function setModels($models)
  {
    $this->models = $models;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1betaCustomTuningModel[]
   */
  public function getModels()
  {
    return $this->models;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1betaListCustomModelsResponse::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1betaListCustomModelsResponse');
