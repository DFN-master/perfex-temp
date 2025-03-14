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

namespace Google\Service\SA360;

class GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategy extends \Google\Model
{
  /**
   * @var string
   */
  public $id;
  protected $maximizeConversionValueType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversionValue::class;
  protected $maximizeConversionValueDataType = '';
  protected $maximizeConversionsType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversions::class;
  protected $maximizeConversionsDataType = '';
  /**
   * @var string
   */
  public $name;
  /**
   * @var string
   */
  public $ownerCustomerId;
  /**
   * @var string
   */
  public $ownerDescriptiveName;
  /**
   * @var string
   */
  public $resourceName;
  protected $targetCpaType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetCpa::class;
  protected $targetCpaDataType = '';
  protected $targetImpressionShareType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetImpressionShare::class;
  protected $targetImpressionShareDataType = '';
  protected $targetRoasType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetRoas::class;
  protected $targetRoasDataType = '';
  protected $targetSpendType = GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetSpend::class;
  protected $targetSpendDataType = '';
  /**
   * @var string
   */
  public $type;

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
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversionValue
   */
  public function setMaximizeConversionValue(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversionValue $maximizeConversionValue)
  {
    $this->maximizeConversionValue = $maximizeConversionValue;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversionValue
   */
  public function getMaximizeConversionValue()
  {
    return $this->maximizeConversionValue;
  }
  /**
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversions
   */
  public function setMaximizeConversions(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversions $maximizeConversions)
  {
    $this->maximizeConversions = $maximizeConversions;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyMaximizeConversions
   */
  public function getMaximizeConversions()
  {
    return $this->maximizeConversions;
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
   * @param string
   */
  public function setOwnerCustomerId($ownerCustomerId)
  {
    $this->ownerCustomerId = $ownerCustomerId;
  }
  /**
   * @return string
   */
  public function getOwnerCustomerId()
  {
    return $this->ownerCustomerId;
  }
  /**
   * @param string
   */
  public function setOwnerDescriptiveName($ownerDescriptiveName)
  {
    $this->ownerDescriptiveName = $ownerDescriptiveName;
  }
  /**
   * @return string
   */
  public function getOwnerDescriptiveName()
  {
    return $this->ownerDescriptiveName;
  }
  /**
   * @param string
   */
  public function setResourceName($resourceName)
  {
    $this->resourceName = $resourceName;
  }
  /**
   * @return string
   */
  public function getResourceName()
  {
    return $this->resourceName;
  }
  /**
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetCpa
   */
  public function setTargetCpa(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetCpa $targetCpa)
  {
    $this->targetCpa = $targetCpa;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetCpa
   */
  public function getTargetCpa()
  {
    return $this->targetCpa;
  }
  /**
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetImpressionShare
   */
  public function setTargetImpressionShare(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetImpressionShare $targetImpressionShare)
  {
    $this->targetImpressionShare = $targetImpressionShare;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetImpressionShare
   */
  public function getTargetImpressionShare()
  {
    return $this->targetImpressionShare;
  }
  /**
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetRoas
   */
  public function setTargetRoas(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetRoas $targetRoas)
  {
    $this->targetRoas = $targetRoas;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetRoas
   */
  public function getTargetRoas()
  {
    return $this->targetRoas;
  }
  /**
   * @param GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetSpend
   */
  public function setTargetSpend(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetSpend $targetSpend)
  {
    $this->targetSpend = $targetSpend;
  }
  /**
   * @return GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategyTargetSpend
   */
  public function getTargetSpend()
  {
    return $this->targetSpend;
  }
  /**
   * @param string
   */
  public function setType($type)
  {
    $this->type = $type;
  }
  /**
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategy::class, 'Google_Service_SA360_GoogleAdsSearchads360V0ResourcesAccessibleBiddingStrategy');
