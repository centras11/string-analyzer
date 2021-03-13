<?php

declare(strict_types=1);

namespace Analyzer\View\Group;

/**
 * Class Max
 * @package Analyzer\View\Output
 */
class Max implements GroupInterface
{
    private string $title = 'Maximum';

    /**
     * @inheritDoc
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @inheritDoc
     */
    public function getData(array $data): array
    {
        array_multisort($data, SORT_DESC);

        return [$data[0]];
    }
}
