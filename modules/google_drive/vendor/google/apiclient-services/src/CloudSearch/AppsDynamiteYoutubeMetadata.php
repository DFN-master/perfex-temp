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

namespace Google\Service\CloudSearch;

class AppsDynamiteYoutubeMetadata extends \Google\Model
{
  /**
   * @var string
   */
  public $id;
  /**
   * @var bool
   */
  public $shouldNotRender;
  /**
   * @var int
   */
  public $startTime;

  /**
   * @param string
   */
  public function setId($id)
  {
    $this->id = $id;
  }
  /**
   * @return string
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param bool
   */
  public function setShouldNotRender($shouldNotRender)
  {
    $this->shouldNotRender = $shouldNotRender;
  }
  /**
   * @return bool
   */
  public function getShouldNotRender()
  {
    return $this->shouldNotRender;
  }
  /**
   * @param int
   */
  public function setStartTime($startTime)
  {
    $this->startTime = $startTime;
  }
  /**
   * @return int
   */
  public function getStartTime()
  {
    return $this->startTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AppsDynamiteYoutubeMetadata::class, 'Google_Service_CloudSearch_AppsDynamiteYoutubeMetadata');
