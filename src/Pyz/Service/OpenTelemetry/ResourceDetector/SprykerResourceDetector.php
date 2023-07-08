<?php
declare(strict_types=1);

namespace Pyz\Service\OpenTelemetry\ResourceDetector;

use OpenTelemetry\SDK\Common\Attribute\Attributes;
use OpenTelemetry\SDK\Resource\ResourceInfo;
use OpenTelemetry\SemConv\ResourceAttributes;

class SprykerResourceDetector implements \OpenTelemetry\SDK\Resource\ResourceDetectorInterface
{
    public function getResource(): ResourceInfo
    {
        $attributes['spryker.store'] = 'DE';
        $attributes['spryker.is'] = 'the best';
        $attributes['spryker'] = 'what do we love';

        return ResourceInfo::create(Attributes::create($attributes), ResourceAttributes::SCHEMA_URL);
    }
}
