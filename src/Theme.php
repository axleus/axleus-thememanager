<?php

declare(strict_types=1);

namespace Axleus\ThemeManager;

use Laminas\Stdlib\ArrayObject;
use Override;
use RuntimeException;

use function sprintf;

class Theme extends ArrayObject implements ThemeInterface
{
    public function __construct(
        array $input = []
    ) {
        parent::__construct($input, ArrayObject::ARRAY_AS_PROPS);
    }

    public function asset(string $type, string $file): string
    {
        // todo: improve handling of missing keys
        return sprintf($this->offsetGet('assetMap')[$type], $this->offsetGet('name'), $file);
    }

    public static function factory(array $data): static
    {
        return new static($data);
    }

    #[Override]
    public function exchangeArray($data): void
    {
        throw new RuntimeException('This instance is read-only');
    }
}
