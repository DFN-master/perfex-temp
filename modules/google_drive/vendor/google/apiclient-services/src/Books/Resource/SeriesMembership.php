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

namespace Google\Service\Books\Resource;

use Google\Service\Books\Seriesmembership as SeriesmembershipModel;

/**
 * The "membership" collection of methods.
 * Typical usage is:
 *  <code>
 *   $booksService = new Google\Service\Books(...);
 *   $membership = $booksService->series_membership;
 *  </code>
 */
class SeriesMembership extends \Google\Service\Resource
{
  /**
   * Returns Series membership data given the series id. (membership.get)
   *
   * @param string $seriesId String that identifies the series
   * @param array $optParams Optional parameters.
   *
   * @opt_param string page_size Number of maximum results per page to be included
   * in the response.
   * @opt_param string page_token The value of the nextToken from the previous
   * page.
   * @return SeriesmembershipModel
   * @throws \Google\Service\Exception
   */
  public function get($seriesId, $optParams = [])
  {
    $params = ['series_id' => $seriesId];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], SeriesmembershipModel::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SeriesMembership::class, 'Google_Service_Books_Resource_SeriesMembership');
