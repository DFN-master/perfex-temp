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

namespace Google\Service\Aiplatform;

class GoogleCloudAiplatformV1Explanation extends \Google\Collection
{
  protected $collection_key = 'neighbors';
  protected $attributionsType = GoogleCloudAiplatformV1Attribution::class;
  protected $attributionsDataType = 'array';
  protected $neighborsType = GoogleCloudAiplatformV1Neighbor::class;
  protected $neighborsDataType = 'array';

  /**
   * @param GoogleCloudAiplatformV1Attribution[]
   */
  public function setAttributions($attributions)
  {
    $this->attributions = $attributions;
  }
  /**
   * @return GoogleCloudAiplatformV1Attribution[]
   */
  public function getAttributions()
  {
    return $this->attributions;
  }
  /**
   * @param GoogleCloudAiplatformV1Neighbor[]
   */
  public function setNeighbors($neighbors)
  {
    $this->neighbors = $neighbors;
  }
  /**
   * @return GoogleCloudAiplatformV1Neighbor[]
   */
  public function getNeighbors()
  {
    return $this->neighbors;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1Explanation::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1Explanation');
