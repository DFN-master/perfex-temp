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

namespace Google\Service\GKEHub;

class OnPremCluster extends \Google\Model
{
  /**
   * @var bool
   */
  public $adminCluster;
  /**
   * @var bool
   */
  public $clusterMissing;
  /**
   * @var string
   */
  public $clusterType;
  /**
   * @var string
   */
  public $resourceLink;

  /**
   * @param bool
   */
  public function setAdminCluster($adminCluster)
  {
    $this->adminCluster = $adminCluster;
  }
  /**
   * @return bool
   */
  public function getAdminCluster()
  {
    return $this->adminCluster;
  }
  /**
   * @param bool
   */
  public function setClusterMissing($clusterMissing)
  {
    $this->clusterMissing = $clusterMissing;
  }
  /**
   * @return bool
   */
  public function getClusterMissing()
  {
    return $this->clusterMissing;
  }
  /**
   * @param string
   */
  public function setClusterType($clusterType)
  {
    $this->clusterType = $clusterType;
  }
  /**
   * @return string
   */
  public function getClusterType()
  {
    return $this->clusterType;
  }
  /**
   * @param string
   */
  public function setResourceLink($resourceLink)
  {
    $this->resourceLink = $resourceLink;
  }
  /**
   * @return string
   */
  public function getResourceLink()
  {
    return $this->resourceLink;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OnPremCluster::class, 'Google_Service_GKEHub_OnPremCluster');
