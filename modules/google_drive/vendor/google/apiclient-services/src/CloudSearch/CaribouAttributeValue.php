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

class CaribouAttributeValue extends \Google\Model
{
  /**
   * @var bool
   */
  public $booleanValue;
  /**
   * @var int
   */
  public $intValue;
  /**
   * @var string
   */
  public $longValue;
  /**
   * @var string
   */
  public $rawByteValue;
  /**
   * @var string
   */
  public $stringValue;

  /**
   * @param bool
   */
  public function setBooleanValue($booleanValue)
  {
    $this->booleanValue = $booleanValue;
  }
  /**
   * @return bool
   */
  public function getBooleanValue()
  {
    return $this->booleanValue;
  }
  /**
   * @param int
   */
  public function setIntValue($intValue)
  {
    $this->intValue = $intValue;
  }
  /**
   * @return int
   */
  public function getIntValue()
  {
    return $this->intValue;
  }
  /**
   * @param string
   */
  public function setLongValue($longValue)
  {
    $this->longValue = $longValue;
  }
  /**
   * @return string
   */
  public function getLongValue()
  {
    return $this->longValue;
  }
  /**
   * @param string
   */
  public function setRawByteValue($rawByteValue)
  {
    $this->rawByteValue = $rawByteValue;
  }
  /**
   * @return string
   */
  public function getRawByteValue()
  {
    return $this->rawByteValue;
  }
  /**
   * @param string
   */
  public function setStringValue($stringValue)
  {
    $this->stringValue = $stringValue;
  }
  /**
   * @return string
   */
  public function getStringValue()
  {
    return $this->stringValue;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CaribouAttributeValue::class, 'Google_Service_CloudSearch_CaribouAttributeValue');
