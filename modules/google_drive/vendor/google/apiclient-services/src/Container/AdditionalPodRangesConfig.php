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

namespace Google\Service\Container;

class AdditionalPodRangesConfig extends \Google\Collection
{
  protected $collection_key = 'podRangeNames';
  protected $podRangeInfoType = RangeInfo::class;
  protected $podRangeInfoDataType = 'array';
  /**
   * @var string[]
   */
  public $podRangeNames;

  /**
   * @param RangeInfo[]
   */
  public function setPodRangeInfo($podRangeInfo)
  {
    $this->podRangeInfo = $podRangeInfo;
  }
  /**
   * @return RangeInfo[]
   */
  public function getPodRangeInfo()
  {
    return $this->podRangeInfo;
  }
  /**
   * @param string[]
   */
  public function setPodRangeNames($podRangeNames)
  {
    $this->podRangeNames = $podRangeNames;
  }
  /**
   * @return string[]
   */
  public function getPodRangeNames()
  {
    return $this->podRangeNames;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AdditionalPodRangesConfig::class, 'Google_Service_Container_AdditionalPodRangesConfig');
