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

class DnsZonePair extends \Google\Model
{
  protected $consumerPeeringZoneType = DnsZone::class;
  protected $consumerPeeringZoneDataType = '';
  protected $producerPrivateZoneType = DnsZone::class;
  protected $producerPrivateZoneDataType = '';

  /**
   * @param DnsZone
   */
  public function setConsumerPeeringZone(DnsZone $consumerPeeringZone)
  {
    $this->consumerPeeringZone = $consumerPeeringZone;
  }
  /**
   * @return DnsZone
   */
  public function getConsumerPeeringZone()
  {
    return $this->consumerPeeringZone;
  }
  /**
   * @param DnsZone
   */
  public function setProducerPrivateZone(DnsZone $producerPrivateZone)
  {
    $this->producerPrivateZone = $producerPrivateZone;
  }
  /**
   * @return DnsZone
   */
  public function getProducerPrivateZone()
  {
    return $this->producerPrivateZone;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DnsZonePair::class, 'Google_Service_ServiceNetworking_DnsZonePair');
