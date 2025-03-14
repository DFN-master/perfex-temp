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

namespace Google\Service\Walletobjects;

class BoardingAndSeatingPolicy extends \Google\Model
{
  /**
   * @var string
   */
  public $boardingPolicy;
  /**
   * @var string
   */
  public $kind;
  /**
   * @var string
   */
  public $seatClassPolicy;

  /**
   * @param string
   */
  public function setBoardingPolicy($boardingPolicy)
  {
    $this->boardingPolicy = $boardingPolicy;
  }
  /**
   * @return string
   */
  public function getBoardingPolicy()
  {
    return $this->boardingPolicy;
  }
  /**
   * @param string
   */
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  /**
   * @return string
   */
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param string
   */
  public function setSeatClassPolicy($seatClassPolicy)
  {
    $this->seatClassPolicy = $seatClassPolicy;
  }
  /**
   * @return string
   */
  public function getSeatClassPolicy()
  {
    return $this->seatClassPolicy;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BoardingAndSeatingPolicy::class, 'Google_Service_Walletobjects_BoardingAndSeatingPolicy');
