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

namespace Google\Service\WorkloadManager;

class Cluster extends \Google\Collection
{
  protected $collection_key = 'nodes';
  /**
   * @var string[]
   */
  public $nodes;
  /**
   * @var string
   */
  public $witnessServer;

  /**
   * @param string[]
   */
  public function setNodes($nodes)
  {
    $this->nodes = $nodes;
  }
  /**
   * @return string[]
   */
  public function getNodes()
  {
    return $this->nodes;
  }
  /**
   * @param string
   */
  public function setWitnessServer($witnessServer)
  {
    $this->witnessServer = $witnessServer;
  }
  /**
   * @return string
   */
  public function getWitnessServer()
  {
    return $this->witnessServer;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Cluster::class, 'Google_Service_WorkloadManager_Cluster');
