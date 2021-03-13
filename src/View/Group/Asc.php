<?php

declare(strict_types=1);

namespace Analyzer\View\Group;

/**
 * Class Max
 * @package Analyzer\View\Output
 */
class Asc implements GroupInterface
{
    private string $title = 'Order by ASC';

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
        array_multisort($data, SORT_ASC);

        return $data;
    }
}
