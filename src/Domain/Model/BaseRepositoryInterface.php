<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Infrastructure\Exception\WritingException;

interface BaseRepositoryInterface
{
    /**
     * @param AggregateRoot $root
     *
     * @return void
     *
     * @throws WritingException
     */
    public function save(AggregateRoot $root): void;
}