<?php

declare(strict_types=1);

namespace Axleus\ThemeManager;

interface ThemeInterface
{
    /**
     * Exchange the array for another one.
     *
     * @param array<TKey, TValue>|ArrayObject<TKey, TValue>|ArrayIterator<TKey, TValue>|object $data
     * @return array<TKey, TValue>
     */
    public function exchangeArray($data);

    public static function factory(array $input): static;

    public function asset(string $type, string $file): string;
}
