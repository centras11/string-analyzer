<?php

declare(strict_types=1);

namespace Analyzer\View\Group;

/**
 * Interface GroupInterface
 * @package Analyzer\View\Group
 */
interface GroupInterface
{
    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param array $data
     *
     * @return array
     */
    public function getData(array $data): array;
}
