<?php namespace Neomerx\JsonApi\Contracts\Encoder;

/**
 * Copyright 2015-2018 info@neomerx.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use Iterator;
use Neomerx\JsonApi\Contracts\Document\ErrorInterface;
use Neomerx\JsonApi\Contracts\Encoder\Parameters\EncodingParametersInterface;
use Neomerx\JsonApi\Exceptions\ErrorCollection;

/**
 * @package Neomerx\JsonApi
 */
interface EncoderInterface
{
    /** JSON API version implemented by the encoder */
    const JSON_API_VERSION = '1.0';

    /**
     * Add links that will be encoded with data. Links must be in array<string,LinkInterface> format.
     *
     * @param array $links
     *
     * @return self
     */
    public function withLinks(array $links): self;

    /**
     * Add meta information that will be encoded with data. If 'null' meta will not appear in a document.
     *
     * @param mixed|null $meta
     *
     * @return self
     */
    public function withMeta($meta): self;

    /**
     * If called JSON API version information with optional meta will be added to a document.
     *
     * @param mixed|null $version
     *
     * @return self
     *
     * @see http://jsonapi.org/format/#document-jsonapi-object
     */
    public function withJsonApiVersion($version = null): self;

    /**
     * Add 'self' Link to top-level document's 'links' section for relationship specified.
     *
     * @param object     $resource
     * @param string     $relationshipName
     * @param null|mixed $meta
     * @param bool       $treatAsHref
     *
     * @see http://jsonapi.org/format/#fetching-relationships
     *
     * @return self
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function withRelationshipSelfLink(
        $resource,
        string $relationshipName,
        $meta = null,
        bool $treatAsHref = false
    ): self;

    /**
     * Add 'related' Link to top-level document's 'links' section for relationship specified.
     *
     * @param object     $resource
     * @param string     $relationshipName
     * @param null|mixed $meta
     * @param bool       $treatAsHref
     *
     * @see http://jsonapi.org/format/#fetching-relationships
     *
     * @return self
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function withRelationshipRelatedLink(
        $resource,
        string $relationshipName,
        $meta = null,
        bool $treatAsHref = false
    ): self;

    /**
     * Encode input as JSON API string.
     *
     * @param object|array|Iterator|null       $data       Data to encode.
     * @param EncodingParametersInterface|null $parameters Encoding parameters.
     *
     * @return string
     */
    public function encodeData($data, EncodingParametersInterface $parameters = null): string;

    /**
     * Encode input as JSON API string with a list of resource identifiers.
     *
     * @param object|array|Iterator|null       $data       Data to encode.
     * @param EncodingParametersInterface|null $parameters Encoding parameters.
     *
     * @return string
     */
    public function encodeIdentifiers($data, EncodingParametersInterface $parameters = null): string;

    /**
     * Encode error as JSON API string.
     *
     * @param ErrorInterface $error
     *
     * @return string
     */
    public function encodeError(ErrorInterface $error): string;

    /**
     * Encode errors as JSON API string.
     *
     * @param ErrorInterface[]|ErrorCollection $errors
     *
     * @return string
     */
    public function encodeErrors($errors): string;

    /**
     * Encode input meta as JSON API string.
     *
     * @param mixed $meta Meta information.
     *
     * @return string
     */
    public function encodeMeta($meta): string;
}
