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

class DetailsItemInfo extends \Google\Model
{
  protected $itemType = TemplateItem::class;
  protected $itemDataType = '';

  /**
   * @param TemplateItem
   */
  public function setItem(TemplateItem $item)
  {
    $this->item = $item;
  }
  /**
   * @return TemplateItem
   */
  public function getItem()
  {
    return $this->item;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DetailsItemInfo::class, 'Google_Service_Walletobjects_DetailsItemInfo');
