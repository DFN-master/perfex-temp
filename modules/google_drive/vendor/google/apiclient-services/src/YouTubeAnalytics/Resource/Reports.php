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

namespace Google\Service\YouTubeAnalytics\Resource;

use Google\Service\YouTubeAnalytics\QueryResponse;

/**
 * The "reports" collection of methods.
 * Typical usage is:
 *  <code>
 *   $youtubeAnalyticsService = new Google\Service\YouTubeAnalytics(...);
 *   $reports = $youtubeAnalyticsService->reports;
 *  </code>
 */
class Reports extends \Google\Service\Resource
{
  /**
   * Retrieve your YouTube Analytics reports. (reports.query)
   *
   * @param array $optParams Optional parameters.
   *
   * @opt_param string currency The currency to which financial metrics should be
   * converted. The default is US Dollar (USD). If the result contains no
   * financial metrics, this flag will be ignored. Responds with an error if the
   * specified currency is not recognized.", pattern: [A-Z]{3}
   * @opt_param string dimensions A comma-separated list of YouTube Analytics
   * dimensions, such as `views` or `ageGroup,gender`. See the [Available
   * Reports](/youtube/analytics/v2/available_reports) document for a list of the
   * reports that you can retrieve and the dimensions used for those reports. Also
   * see the [Dimensions](/youtube/analytics/v2/dimsmets/dims) document for
   * definitions of those dimensions." pattern: [0-9a-zA-Z,]+
   * @opt_param string endDate The end date for fetching YouTube Analytics data.
   * The value should be in `YYYY-MM-DD` format. required: true, pattern:
   * [0-9]{4}-[0-9]{2}-[0-9]{2}
   * @opt_param string filters A list of filters that should be applied when
   * retrieving YouTube Analytics data. The [Available
   * Reports](/youtube/analytics/v2/available_reports) document identifies the
   * dimensions that can be used to filter each report, and the
   * [Dimensions](/youtube/analytics/v2/dimsmets/dims) document defines those
   * dimensions. If a request uses multiple filters, join them together with a
   * semicolon (`;`), and the returned result table will satisfy both filters. For
   * example, a filters parameter value of `video==dMH0bHeiRNg;country==IT`
   * restricts the result set to include data for the given video in Italy.",
   * @opt_param string ids Identifies the YouTube channel or content owner for
   * which you are retrieving YouTube Analytics data. - To request data for a
   * YouTube user, set the `ids` parameter value to `channel==CHANNEL_ID`, where
   * `CHANNEL_ID` specifies the unique YouTube channel ID. - To request data for a
   * YouTube CMS content owner, set the `ids` parameter value to
   * `contentOwner==OWNER_NAME`, where `OWNER_NAME` is the CMS name of the content
   * owner. required: true, pattern: [a-zA-Z]+==[a-zA-Z0-9_+-]+
   * @opt_param bool includeHistoricalChannelData If set to true historical data
   * (i.e. channel data from before the linking of the channel to the content
   * owner) will be retrieved.",
   * @opt_param int maxResults The maximum number of rows to include in the
   * response.", minValue: 1
   * @opt_param string metrics A comma-separated list of YouTube Analytics
   * metrics, such as `views` or `likes,dislikes`. See the [Available
   * Reports](/youtube/analytics/v2/available_reports) document for a list of the
   * reports that you can retrieve and the metrics available in each report, and
   * see the [Metrics](/youtube/analytics/v2/dimsmets/mets) document for
   * definitions of those metrics. required: true, pattern: [0-9a-zA-Z,]+
   * @opt_param string sort A comma-separated list of dimensions or metrics that
   * determine the sort order for YouTube Analytics data. By default the sort
   * order is ascending. The '`-`' prefix causes descending sort order.", pattern:
   * [-0-9a-zA-Z,]+
   * @opt_param string startDate The start date for fetching YouTube Analytics
   * data. The value should be in `YYYY-MM-DD` format. required: true, pattern:
   * "[0-9]{4}-[0-9]{2}-[0-9]{2}
   * @opt_param int startIndex An index of the first entity to retrieve. Use this
   * parameter as a pagination mechanism along with the max-results parameter
   * (one-based, inclusive).", minValue: 1
   * @return QueryResponse
   * @throws \Google\Service\Exception
   */
  public function query($optParams = [])
  {
    $params = [];
    $params = array_merge($params, $optParams);
    return $this->call('query', [$params], QueryResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Reports::class, 'Google_Service_YouTubeAnalytics_Resource_Reports');
