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

class GoogleCloudDiscoveryengineV1betaPageInfo extends \Google\Model
{
  /**
   * @var string
   */
  public $pageCategory;
  /**
   * @var string
   */
  public $pageviewId;
  /**
   * @var string
   */
  public $referrerUri;
  /**
   * @var string
   */
  public $uri;

  /**
   * @param string
   */
  public function setPageCategory($pageCategory)
  {
    $this->pageCategory = $pageCategory;
  }
  /**
   * @return string
   */
  public function getPageCategory()
  {
    return $this->pageCategory;
  }
  /**
   * @param string
   */
  public function setPageviewId($pageviewId)
  {
    $this->pageviewId = $pageviewId;
  }
  /**
   * @return string
   */
  public function getPageviewId()
  {
    return $this->pageviewId;
  }
  /**
   * @param string
   */
  public function setReferrerUri($referrerUri)
  {
    $this->referrerUri = $referrerUri;
  }
  /**
   * @return string
   */
  public function getReferrerUri()
  {
    return $this->referrerUri;
  }
  /**
   * @param string
   */
  public function setUri($uri)
  {
    $this->uri = $uri;
  }
  /**
   * @return string
   */
  public function getUri()
  {
    return $this->uri;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1betaPageInfo::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1betaPageInfo');
