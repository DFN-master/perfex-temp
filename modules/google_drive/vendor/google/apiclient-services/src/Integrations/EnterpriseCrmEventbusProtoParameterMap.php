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

namespace Google\Service\Integrations;

class EnterpriseCrmEventbusProtoParameterMap extends \Google\Collection
{
  protected $collection_key = 'entries';
  protected $entriesType = EnterpriseCrmEventbusProtoParameterMapEntry::class;
  protected $entriesDataType = 'array';
  /**
   * @var string
   */
  public $keyType;
  /**
   * @var string
   */
  public $valueType;

  /**
   * @param EnterpriseCrmEventbusProtoParameterMapEntry[]
   */
  public function setEntries($entries)
  {
    $this->entries = $entries;
  }
  /**
   * @return EnterpriseCrmEventbusProtoParameterMapEntry[]
   */
  public function getEntries()
  {
    return $this->entries;
  }
  /**
   * @param string
   */
  public function setKeyType($keyType)
  {
    $this->keyType = $keyType;
  }
  /**
   * @return string
   */
  public function getKeyType()
  {
    return $this->keyType;
  }
  /**
   * @param string
   */
  public function setValueType($valueType)
  {
    $this->valueType = $valueType;
  }
  /**
   * @return string
   */
  public function getValueType()
  {
    return $this->valueType;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EnterpriseCrmEventbusProtoParameterMap::class, 'Google_Service_Integrations_EnterpriseCrmEventbusProtoParameterMap');
