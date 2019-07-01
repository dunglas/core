<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Metadata\Resource\Factory;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;

/**
 * Normalizes enabled formats.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
final class FormatsResourceMetadataFactory implements ResourceMetadataFactoryInterface
{
    private $decorated;
    private $formats;

    public function __construct(ResourceMetadataFactoryInterface $decorated, array $formats)
    {
        $this->decorated = $decorated;
        $this->formats = $formats;
    }

    /**
     * Creates a resource metadata.
     * PATCH formats are normalized in the OperationResourceMetadataFactory class.
     *
     * @see OperationResourceMetadataFactory
     *
     * @throws ResourceClassNotFoundException
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $resourceMetadata = $this->decorated->create($resourceClass);
        if (null === $resourceMetadata->getAttribute('formats')) {
            $resourceMetadata = $resourceMetadata->withAttributes(['formats' => $this->formats] + $resourceMetadata->getAttributes());
        }

        return $resourceMetadata;
    }
}