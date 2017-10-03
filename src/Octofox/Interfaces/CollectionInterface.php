<?php declare(strict_types = 1);
/**
 * User: Hannes
 * Date: 03.10.2017
 * Time: 15:20
 */

namespace Octofox\Interfaces;

interface CollectionInterface
{
    public function add($data): array;

    public function find($id);

    public function all(): array;

    public function getHash(): string;

    public function equals(CollectionInterface $collection): bool;
}
