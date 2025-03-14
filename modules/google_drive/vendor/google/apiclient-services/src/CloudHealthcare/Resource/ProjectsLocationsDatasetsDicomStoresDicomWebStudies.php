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

namespace Google\Service\CloudHealthcare\Resource;

use Google\Service\CloudHealthcare\StudyMetrics;

/**
 * The "studies" collection of methods.
 * Typical usage is:
 *  <code>
 *   $healthcareService = new Google\Service\CloudHealthcare(...);
 *   $studies = $healthcareService->projects_locations_datasets_dicomStores_dicomWeb_studies;
 *  </code>
 */
class ProjectsLocationsDatasetsDicomStoresDicomWebStudies extends \Google\Service\Resource
{
  /**
   * GetStudyMetrics returns metrics for a study. (studies.getStudyMetrics)
   *
   * @param string $study Required. The study resource path. For example, `project
   * s/{project_id}/locations/{location_id}/datasets/{dataset_id}/dicomStores/{dic
   * om_store_id}/dicomWeb/studies/{study_uid}`.
   * @param array $optParams Optional parameters.
   * @return StudyMetrics
   * @throws \Google\Service\Exception
   */
  public function getStudyMetrics($study, $optParams = [])
  {
    $params = ['study' => $study];
    $params = array_merge($params, $optParams);
    return $this->call('getStudyMetrics', [$params], StudyMetrics::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProjectsLocationsDatasetsDicomStoresDicomWebStudies::class, 'Google_Service_CloudHealthcare_Resource_ProjectsLocationsDatasetsDicomStoresDicomWebStudies');
