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

namespace Google\Service\YouTube;

class PlaylistImageListResponse extends \Google\Collection
{
  protected $collection_key = 'items';
  protected $itemsType = PlaylistImage::class;
  protected $itemsDataType = 'array';
  /**
   * @var string
   */
  public $kind;
  /**
   * @var string
   */
  public $nextPageToken;
  protected $pageInfoType = PageInfo::class;
  protected $pageInfoDataType = '';
  /**
   * @var string
   */
  public $prevPageToken;

  /**
   * @param PlaylistImage[]
   */
  public function setItems($items)
  {
    $this->items = $items;
  }
  /**
   * @return PlaylistImage[]
   */
  public function getItems()
  {
    return $this->items;
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
  public function setNextPageToken($nextPageToken)
  {
    $this->nextPageToken = $nextPageToken;
  }
  /**
   * @return string
   */
  public function getNextPageToken()
  {
    return $this->nextPageToken;
  }
  /**
   * @param PageInfo
   */
  public function setPageInfo(PageInfo $pageInfo)
  {
    $this->pageInfo = $pageInfo;
  }
  /**
   * @return PageInfo
   */
  public function getPageInfo()
  {
    return $this->pageInfo;
  }
  /**
   * @param string
   */
  public function setPrevPageToken($prevPageToken)
  {
    $this->prevPageToken = $prevPageToken;
  }
  /**
   * @return string
   */
  public function getPrevPageToken()
  {
    return $this->prevPageToken;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PlaylistImageListResponse::class, 'Google_Service_YouTube_PlaylistImageListResponse');
