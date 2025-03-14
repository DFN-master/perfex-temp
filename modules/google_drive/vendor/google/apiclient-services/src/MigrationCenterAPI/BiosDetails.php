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

namespace Google\Service\MigrationCenterAPI;

class BiosDetails extends \Google\Model
{
  /**
   * @var string
   */
  public $biosName;
  /**
   * @var string
   */
  public $id;
  /**
   * @var string
   */
  public $manufacturer;
  protected $releaseDateType = Date::class;
  protected $releaseDateDataType = '';
  /**
   * @var string
   */
  public $smbiosUuid;
  /**
   * @var string
   */
  public $version;

  /**
   * @param string
   */
  public function setBiosName($biosName)
  {
    $this->biosName = $biosName;
  }
  /**
   * @return string
   */
  public function getBiosName()
  {
    return $this->biosName;
  }
  /**
   * @param string
   */
  public function setId($id)
  {
    $this->id = $id;
  }
  /**
   * @return string
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param string
   */
  public function setManufacturer($manufacturer)
  {
    $this->manufacturer = $manufacturer;
  }
  /**
   * @return string
   */
  public function getManufacturer()
  {
    return $this->manufacturer;
  }
  /**
   * @param Date
   */
  public function setReleaseDate(Date $releaseDate)
  {
    $this->releaseDate = $releaseDate;
  }
  /**
   * @return Date
   */
  public function getReleaseDate()
  {
    return $this->releaseDate;
  }
  /**
   * @param string
   */
  public function setSmbiosUuid($smbiosUuid)
  {
    $this->smbiosUuid = $smbiosUuid;
  }
  /**
   * @return string
   */
  public function getSmbiosUuid()
  {
    return $this->smbiosUuid;
  }
  /**
   * @param string
   */
  public function setVersion($version)
  {
    $this->version = $version;
  }
  /**
   * @return string
   */
  public function getVersion()
  {
    return $this->version;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BiosDetails::class, 'Google_Service_MigrationCenterAPI_BiosDetails');
