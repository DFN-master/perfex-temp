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

namespace Google\Service\CloudDataplex\Resource;

use Google\Service\CloudDataplex\GoogleCloudDataplexV1EntryGroup;
use Google\Service\CloudDataplex\GoogleCloudDataplexV1ListEntryGroupsResponse;
use Google\Service\CloudDataplex\GoogleIamV1Policy;
use Google\Service\CloudDataplex\GoogleIamV1SetIamPolicyRequest;
use Google\Service\CloudDataplex\GoogleIamV1TestIamPermissionsRequest;
use Google\Service\CloudDataplex\GoogleIamV1TestIamPermissionsResponse;
use Google\Service\CloudDataplex\GoogleLongrunningOperation;

/**
 * The "entryGroups" collection of methods.
 * Typical usage is:
 *  <code>
 *   $dataplexService = new Google\Service\CloudDataplex(...);
 *   $entryGroups = $dataplexService->projects_locations_entryGroups;
 *  </code>
 */
class ProjectsLocationsEntryGroups extends \Google\Service\Resource
{
  /**
   * Creates an EntryGroup. (entryGroups.create)
   *
   * @param string $parent Required. The resource name of the entryGroup, of the
   * form: projects/{project_number}/locations/{location_id} where location_id
   * refers to a GCP region.
   * @param GoogleCloudDataplexV1EntryGroup $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string entryGroupId Required. EntryGroup identifier.
   * @opt_param bool validateOnly Optional. The service validates the request
   * without performing any mutations. The default is false.
   * @return GoogleLongrunningOperation
   * @throws \Google\Service\Exception
   */
  public function create($parent, GoogleCloudDataplexV1EntryGroup $postBody, $optParams = [])
  {
    $params = ['parent' => $parent, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('create', [$params], GoogleLongrunningOperation::class);
  }
  /**
   * Deletes an EntryGroup. (entryGroups.delete)
   *
   * @param string $name Required. The resource name of the EntryGroup: projects/{
   * project_number}/locations/{location_id}/entryGroups/{entry_group_id}.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string etag Optional. If the client provided etag value does not
   * match the current etag value, the DeleteEntryGroupRequest method returns an
   * ABORTED error response.
   * @return GoogleLongrunningOperation
   * @throws \Google\Service\Exception
   */
  public function delete($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('delete', [$params], GoogleLongrunningOperation::class);
  }
  /**
   * Gets an EntryGroup. (entryGroups.get)
   *
   * @param string $name Required. The resource name of the EntryGroup: projects/{
   * project_number}/locations/{location_id}/entryGroups/{entry_group_id}.
   * @param array $optParams Optional parameters.
   * @return GoogleCloudDataplexV1EntryGroup
   * @throws \Google\Service\Exception
   */
  public function get($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], GoogleCloudDataplexV1EntryGroup::class);
  }
  /**
   * Gets the access control policy for a resource. Returns an empty policy if the
   * resource exists and does not have a policy set. (entryGroups.getIamPolicy)
   *
   * @param string $resource REQUIRED: The resource for which the policy is being
   * requested. See Resource names
   * (https://cloud.google.com/apis/design/resource_names) for the appropriate
   * value for this field.
   * @param array $optParams Optional parameters.
   *
   * @opt_param int options.requestedPolicyVersion Optional. The maximum policy
   * version that will be used to format the policy.Valid values are 0, 1, and 3.
   * Requests specifying an invalid value will be rejected.Requests for policies
   * with any conditional role bindings must specify version 3. Policies with no
   * conditional role bindings may specify any valid value or leave the field
   * unset.The policy in the response might use the policy version that you
   * specified, or it might use a lower policy version. For example, if you
   * specify version 3, but the policy has no conditional role bindings, the
   * response uses version 1.To learn which resources support conditions in their
   * IAM policies, see the IAM documentation
   * (https://cloud.google.com/iam/help/conditions/resource-policies).
   * @return GoogleIamV1Policy
   * @throws \Google\Service\Exception
   */
  public function getIamPolicy($resource, $optParams = [])
  {
    $params = ['resource' => $resource];
    $params = array_merge($params, $optParams);
    return $this->call('getIamPolicy', [$params], GoogleIamV1Policy::class);
  }
  /**
   * Lists EntryGroup resources in a project and location.
   * (entryGroups.listProjectsLocationsEntryGroups)
   *
   * @param string $parent Required. The resource name of the entryGroup location,
   * of the form: projects/{project_number}/locations/{location_id} where
   * location_id refers to a Google Cloud region.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter Optional. Filter request.
   * @opt_param string orderBy Optional. Order by fields for the result.
   * @opt_param int pageSize Optional. Maximum number of EntryGroups to return.
   * The service may return fewer than this value. If unspecified, the service
   * returns at most 10 EntryGroups. The maximum value is 1000; values above 1000
   * will be coerced to 1000.
   * @opt_param string pageToken Optional. Page token received from a previous
   * ListEntryGroups call. Provide this to retrieve the subsequent page. When
   * paginating, all other parameters you provide to ListEntryGroups must match
   * the call that provided the page token.
   * @return GoogleCloudDataplexV1ListEntryGroupsResponse
   * @throws \Google\Service\Exception
   */
  public function listProjectsLocationsEntryGroups($parent, $optParams = [])
  {
    $params = ['parent' => $parent];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], GoogleCloudDataplexV1ListEntryGroupsResponse::class);
  }
  /**
   * Updates an EntryGroup. (entryGroups.patch)
   *
   * @param string $name Output only. The relative resource name of the
   * EntryGroup, of the form: projects/{project_number}/locations/{location_id}/en
   * tryGroups/{entry_group_id}.
   * @param GoogleCloudDataplexV1EntryGroup $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask Required. Mask of fields to update.
   * @opt_param bool validateOnly Optional. The service validates the request,
   * without performing any mutations. The default is false.
   * @return GoogleLongrunningOperation
   * @throws \Google\Service\Exception
   */
  public function patch($name, GoogleCloudDataplexV1EntryGroup $postBody, $optParams = [])
  {
    $params = ['name' => $name, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('patch', [$params], GoogleLongrunningOperation::class);
  }
  /**
   * Sets the access control policy on the specified resource. Replaces any
   * existing policy.Can return NOT_FOUND, INVALID_ARGUMENT, and PERMISSION_DENIED
   * errors. (entryGroups.setIamPolicy)
   *
   * @param string $resource REQUIRED: The resource for which the policy is being
   * specified. See Resource names
   * (https://cloud.google.com/apis/design/resource_names) for the appropriate
   * value for this field.
   * @param GoogleIamV1SetIamPolicyRequest $postBody
   * @param array $optParams Optional parameters.
   * @return GoogleIamV1Policy
   * @throws \Google\Service\Exception
   */
  public function setIamPolicy($resource, GoogleIamV1SetIamPolicyRequest $postBody, $optParams = [])
  {
    $params = ['resource' => $resource, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('setIamPolicy', [$params], GoogleIamV1Policy::class);
  }
  /**
   * Returns permissions that a caller has on the specified resource. If the
   * resource does not exist, this will return an empty set of permissions, not a
   * NOT_FOUND error.Note: This operation is designed to be used for building
   * permission-aware UIs and command-line tools, not for authorization checking.
   * This operation may "fail open" without warning.
   * (entryGroups.testIamPermissions)
   *
   * @param string $resource REQUIRED: The resource for which the policy detail is
   * being requested. See Resource names
   * (https://cloud.google.com/apis/design/resource_names) for the appropriate
   * value for this field.
   * @param GoogleIamV1TestIamPermissionsRequest $postBody
   * @param array $optParams Optional parameters.
   * @return GoogleIamV1TestIamPermissionsResponse
   * @throws \Google\Service\Exception
   */
  public function testIamPermissions($resource, GoogleIamV1TestIamPermissionsRequest $postBody, $optParams = [])
  {
    $params = ['resource' => $resource, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('testIamPermissions', [$params], GoogleIamV1TestIamPermissionsResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProjectsLocationsEntryGroups::class, 'Google_Service_CloudDataplex_Resource_ProjectsLocationsEntryGroups');
