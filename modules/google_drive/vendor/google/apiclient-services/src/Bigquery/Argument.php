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

namespace Google\Service\Bigquery;

class Argument extends \Google\Model
{
  /**
   * @var string
   */
  public $argumentKind;
  protected $dataTypeType = StandardSqlDataType::class;
  protected $dataTypeDataType = '';
  /**
   * @var bool
   */
  public $isAggregate;
  /**
   * @var string
   */
  public $mode;
  /**
   * @var string
   */
  public $name;

  /**
   * @param string
   */
  public function setArgumentKind($argumentKind)
  {
    $this->argumentKind = $argumentKind;
  }
  /**
   * @return string
   */
  public function getArgumentKind()
  {
    return $this->argumentKind;
  }
  /**
   * @param StandardSqlDataType
   */
  public function setDataType(StandardSqlDataType $dataType)
  {
    $this->dataType = $dataType;
  }
  /**
   * @return StandardSqlDataType
   */
  public function getDataType()
  {
    return $this->dataType;
  }
  /**
   * @param bool
   */
  public function setIsAggregate($isAggregate)
  {
    $this->isAggregate = $isAggregate;
  }
  /**
   * @return bool
   */
  public function getIsAggregate()
  {
    return $this->isAggregate;
  }
  /**
   * @param string
   */
  public function setMode($mode)
  {
    $this->mode = $mode;
  }
  /**
   * @return string
   */
  public function getMode()
  {
    return $this->mode;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Argument::class, 'Google_Service_Bigquery_Argument');
