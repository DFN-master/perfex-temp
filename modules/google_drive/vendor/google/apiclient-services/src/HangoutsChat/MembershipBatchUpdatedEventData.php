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

namespace Google\Service\HangoutsChat;

class MembershipBatchUpdatedEventData extends \Google\Collection
{
  protected $collection_key = 'memberships';
  protected $membershipsType = MembershipUpdatedEventData::class;
  protected $membershipsDataType = 'array';

  /**
   * @param MembershipUpdatedEventData[]
   */
  public function setMemberships($memberships)
  {
    $this->memberships = $memberships;
  }
  /**
   * @return MembershipUpdatedEventData[]
   */
  public function getMemberships()
  {
    return $this->memberships;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(MembershipBatchUpdatedEventData::class, 'Google_Service_HangoutsChat_MembershipBatchUpdatedEventData');
