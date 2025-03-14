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

namespace Google\Service\Dataflow\Resource;

use Google\Service\Dataflow\ListSnapshotsResponse;
use Google\Service\Dataflow\Snapshot;

/**
 * The "snapshots" collection of methods.
 * Typical usage is:
 *  <code>
 *   $dataflowService = new Google\Service\Dataflow(...);
 *   $snapshots = $dataflowService->projects_snapshots;
 *  </code>
 */
class ProjectsSnapshots extends \Google\Service\Resource
{
  /**
   * Gets information about a snapshot. (snapshots.get)
   *
   * @param string $projectId The ID of the Cloud Platform project that the
   * snapshot belongs to.
   * @param string $snapshotId The ID of the snapshot.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string location The location that contains this snapshot.
   * @return Snapshot
   * @throws \Google\Service\Exception
   */
  public function get($projectId, $snapshotId, $optParams = [])
  {
    $params = ['projectId' => $projectId, 'snapshotId' => $snapshotId];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], Snapshot::class);
  }
  /**
   * Lists snapshots. (snapshots.listProjectsSnapshots)
   *
   * @param string $projectId The project ID to list snapshots for.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string jobId If specified, list snapshots created from this job.
   * @opt_param string location The location to list snapshots in.
   * @return ListSnapshotsResponse
   * @throws \Google\Service\Exception
   */
  public function listProjectsSnapshots($projectId, $optParams = [])
  {
    $params = ['projectId' => $projectId];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ListSnapshotsResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProjectsSnapshots::class, 'Google_Service_Dataflow_Resource_ProjectsSnapshots');
