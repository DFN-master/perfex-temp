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

namespace Google\Service\Iam;

class CreateServiceAccountRequest extends \Google\Model
{
  /**
   * @var string
   */
  public $accountId;
  protected $serviceAccountType = ServiceAccount::class;
  protected $serviceAccountDataType = '';
  public $serviceAccount;

  /**
   * @param string
   */
  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  /**
   * @return string
   */
  public function getAccountId()
  {
    return $this->accountId;
  }
  /**
   * @param ServiceAccount
   */
  public function setServiceAccount(ServiceAccount $serviceAccount)
  {
    $this->serviceAccount = $serviceAccount;
  }
  /**
   * @return ServiceAccount
   */
  public function getServiceAccount()
  {
    return $this->serviceAccount;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CreateServiceAccountRequest::class, 'Google_Service_Iam_CreateServiceAccountRequest');
