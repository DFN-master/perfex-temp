<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\TrustedComms;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Rest\Preview\TrustedComms\Business\BrandList;
use Twilio\Rest\Preview\TrustedComms\Business\InsightsList;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property BrandList $brands
 * @property InsightsList $insights
 * @method \Twilio\Rest\Preview\TrustedComms\Business\BrandContext brands(string $sid)
 */
class BusinessContext extends InstanceContext {
    protected $_brands;
    protected $_insights;

    /**
     * Initialize the BusinessContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid A string that uniquely identifies this Business.
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid, ];

        $this->uri = '/Businesses/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch the BusinessInstance
     *
     * @return BusinessInstance Fetched BusinessInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): BusinessInstance {
        $payload = $this->version->fetch('GET', $this->uri);

        return new BusinessInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Access the brands
     */
    protected function getBrands(): BrandList {
        if (!$this->_brands) {
            $this->_brands = new BrandList($this->version, $this->solution['sid']);
        }

        return $this->_brands;
    }

    /**
     * Access the insights
     */
    protected function getInsights(): InsightsList {
        if (!$this->_insights) {
            $this->_insights = new InsightsList($this->version, $this->solution['sid']);
        }

        return $this->_insights;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.TrustedComms.BusinessContext ' . \implode(' ', $context) . ']';
    }
}