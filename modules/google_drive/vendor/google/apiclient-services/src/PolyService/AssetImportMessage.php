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

namespace Google\Service\PolyService;

class AssetImportMessage extends \Google\Model
{
  /**
   * @var string
   */
  public $code;
  /**
   * @var string
   */
  public $filePath;
  /**
   * @var ImageError
   */
  public $imageError;
  protected $imageErrorType = ImageError::class;
  protected $imageErrorDataType = '';
  /**
   * @var ObjParseError
   */
  public $objParseError;
  protected $objParseErrorType = ObjParseError::class;
  protected $objParseErrorDataType = '';

  /**
   * @param string
   */
  public function setCode($code)
  {
    $this->code = $code;
  }
  /**
   * @return string
   */
  public function getCode()
  {
    return $this->code;
  }
  /**
   * @param string
   */
  public function setFilePath($filePath)
  {
    $this->filePath = $filePath;
  }
  /**
   * @return string
   */
  public function getFilePath()
  {
    return $this->filePath;
  }
  /**
   * @param ImageError
   */
  public function setImageError(ImageError $imageError)
  {
    $this->imageError = $imageError;
  }
  /**
   * @return ImageError
   */
  public function getImageError()
  {
    return $this->imageError;
  }
  /**
   * @param ObjParseError
   */
  public function setObjParseError(ObjParseError $objParseError)
  {
    $this->objParseError = $objParseError;
  }
  /**
   * @return ObjParseError
   */
  public function getObjParseError()
  {
    return $this->objParseError;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AssetImportMessage::class, 'Google_Service_PolyService_AssetImportMessage');
