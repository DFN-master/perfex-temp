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

class AppsDynamiteStorageIcon extends \Google\Model
{
  /**
   * @var string
   */
  public $altText;
  /**
   * @var string
   */
  public $iconUrl;
  /**
   * @var string
   */
  public $imageType;
  /**
   * @var string
   */
  public $knownIcon;
  protected $materialIconType = AppsDynamiteStorageMaterialIcon::class;
  protected $materialIconDataType = '';

  /**
   * @param string
   */
  public function setAltText($altText)
  {
    $this->altText = $altText;
  }
  /**
   * @return string
   */
  public function getAltText()
  {
    return $this->altText;
  }
  /**
   * @param string
   */
  public function setIconUrl($iconUrl)
  {
    $this->iconUrl = $iconUrl;
  }
  /**
   * @return string
   */
  public function getIconUrl()
  {
    return $this->iconUrl;
  }
  /**
   * @param string
   */
  public function setImageType($imageType)
  {
    $this->imageType = $imageType;
  }
  /**
   * @return string
   */
  public function getImageType()
  {
    return $this->imageType;
  }
  /**
   * @param string
   */
  public function setKnownIcon($knownIcon)
  {
    $this->knownIcon = $knownIcon;
  }
  /**
   * @return string
   */
  public function getKnownIcon()
  {
    return $this->knownIcon;
  }
  /**
   * @param AppsDynamiteStorageMaterialIcon
   */
  public function setMaterialIcon(AppsDynamiteStorageMaterialIcon $materialIcon)
  {
    $this->materialIcon = $materialIcon;
  }
  /**
   * @return AppsDynamiteStorageMaterialIcon
   */
  public function getMaterialIcon()
  {
    return $this->materialIcon;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AppsDynamiteStorageIcon::class, 'Google_Service_CloudSearch_AppsDynamiteStorageIcon');
