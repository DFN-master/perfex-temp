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

class FieldPolicy extends \Google\Model
{
  /**
   * @var string
   */
  public $resourcePermission;
  /**
   * @var string
   */
  public $resourceType;
  /**
   * @var string
   */
  public $selector;

  /**
   * @param string
   */
  public function setResourcePermission($resourcePermission)
  {
    $this->resourcePermission = $resourcePermission;
  }
  /**
   * @return string
   */
  public function getResourcePermission()
  {
    return $this->resourcePermission;
  }
  /**
   * @param string
   */
  public function setResourceType($resourceType)
  {
    $this->resourceType = $resourceType;
  }
  /**
   * @return string
   */
  public function getResourceType()
  {
    return $this->resourceType;
  }
  /**
   * @param string
   */
  public function setSelector($selector)
  {
    $this->selector = $selector;
  }
  /**
   * @return string
   */
  public function getSelector()
  {
    return $this->selector;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(FieldPolicy::class, 'Google_Service_ServiceNetworking_FieldPolicy');
