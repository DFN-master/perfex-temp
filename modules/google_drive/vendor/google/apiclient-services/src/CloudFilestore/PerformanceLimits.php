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

namespace Google\Service\CloudFilestore;

class PerformanceLimits extends \Google\Model
{
  /**
   * @var string
   */
  public $maxReadIops;
  /**
   * @var string
   */
  public $maxReadThroughput;
  /**
   * @var string
   */
  public $maxWriteIops;
  /**
   * @var string
   */
  public $maxWriteThroughput;

  /**
   * @param string
   */
  public function setMaxReadIops($maxReadIops)
  {
    $this->maxReadIops = $maxReadIops;
  }
  /**
   * @return string
   */
  public function getMaxReadIops()
  {
    return $this->maxReadIops;
  }
  /**
   * @param string
   */
  public function setMaxReadThroughput($maxReadThroughput)
  {
    $this->maxReadThroughput = $maxReadThroughput;
  }
  /**
   * @return string
   */
  public function getMaxReadThroughput()
  {
    return $this->maxReadThroughput;
  }
  /**
   * @param string
   */
  public function setMaxWriteIops($maxWriteIops)
  {
    $this->maxWriteIops = $maxWriteIops;
  }
  /**
   * @return string
   */
  public function getMaxWriteIops()
  {
    return $this->maxWriteIops;
  }
  /**
   * @param string
   */
  public function setMaxWriteThroughput($maxWriteThroughput)
  {
    $this->maxWriteThroughput = $maxWriteThroughput;
  }
  /**
   * @return string
   */
  public function getMaxWriteThroughput()
  {
    return $this->maxWriteThroughput;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PerformanceLimits::class, 'Google_Service_CloudFilestore_PerformanceLimits');
