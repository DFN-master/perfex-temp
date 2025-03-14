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

namespace Google\Service\NetworkManagement;

class LatencyPercentile extends \Google\Model
{
  /**
   * @var string
   */
  public $latencyMicros;
  /**
   * @var int
   */
  public $percent;

  /**
   * @param string
   */
  public function setLatencyMicros($latencyMicros)
  {
    $this->latencyMicros = $latencyMicros;
  }
  /**
   * @return string
   */
  public function getLatencyMicros()
  {
    return $this->latencyMicros;
  }
  /**
   * @param int
   */
  public function setPercent($percent)
  {
    $this->percent = $percent;
  }
  /**
   * @return int
   */
  public function getPercent()
  {
    return $this->percent;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(LatencyPercentile::class, 'Google_Service_NetworkManagement_LatencyPercentile');
