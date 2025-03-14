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

class GoogleAppsCardV1MaterialIcon extends \Google\Model
{
  /**
   * @var bool
   */
  public $fill;
  /**
   * @var int
   */
  public $grade;
  /**
   * @var string
   */
  public $name;
  /**
   * @var int
   */
  public $weight;

  /**
   * @param bool
   */
  public function setFill($fill)
  {
    $this->fill = $fill;
  }
  /**
   * @return bool
   */
  public function getFill()
  {
    return $this->fill;
  }
  /**
   * @param int
   */
  public function setGrade($grade)
  {
    $this->grade = $grade;
  }
  /**
   * @return int
   */
  public function getGrade()
  {
    return $this->grade;
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
  /**
   * @param int
   */
  public function setWeight($weight)
  {
    $this->weight = $weight;
  }
  /**
   * @return int
   */
  public function getWeight()
  {
    return $this->weight;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAppsCardV1MaterialIcon::class, 'Google_Service_HangoutsChat_GoogleAppsCardV1MaterialIcon');
