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

namespace Google\Service\ServiceNetworking;

class CommonLanguageSettings extends \Google\Collection
{
  protected $collection_key = 'destinations';
  /**
   * @var string[]
   */
  public $destinations;
  /**
   * @var string
   */
  public $referenceDocsUri;

  /**
   * @param string[]
   */
  public function setDestinations($destinations)
  {
    $this->destinations = $destinations;
  }
  /**
   * @return string[]
   */
  public function getDestinations()
  {
    return $this->destinations;
  }
  /**
   * @param string
   */
  public function setReferenceDocsUri($referenceDocsUri)
  {
    $this->referenceDocsUri = $referenceDocsUri;
  }
  /**
   * @return string
   */
  public function getReferenceDocsUri()
  {
    return $this->referenceDocsUri;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CommonLanguageSettings::class, 'Google_Service_ServiceNetworking_CommonLanguageSettings');
