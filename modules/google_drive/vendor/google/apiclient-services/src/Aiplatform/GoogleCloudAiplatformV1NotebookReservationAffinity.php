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

class GoogleCloudAiplatformV1NotebookReservationAffinity extends \Google\Collection
{
  protected $collection_key = 'values';
  /**
   * @var string
   */
  public $consumeReservationType;
  /**
   * @var string
   */
  public $key;
  /**
   * @var string[]
   */
  public $values;

  /**
   * @param string
   */
  public function setConsumeReservationType($consumeReservationType)
  {
    $this->consumeReservationType = $consumeReservationType;
  }
  /**
   * @return string
   */
  public function getConsumeReservationType()
  {
    return $this->consumeReservationType;
  }
  /**
   * @param string
   */
  public function setKey($key)
  {
    $this->key = $key;
  }
  /**
   * @return string
   */
  public function getKey()
  {
    return $this->key;
  }
  /**
   * @param string[]
   */
  public function setValues($values)
  {
    $this->values = $values;
  }
  /**
   * @return string[]
   */
  public function getValues()
  {
    return $this->values;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1NotebookReservationAffinity::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1NotebookReservationAffinity');
