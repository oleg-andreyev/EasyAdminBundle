<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Collection;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Collection\CollectionInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterDto;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 *
 * @implements CollectionInterface<string, FilterDto>
 */
final class FilterCollection implements CollectionInterface
{
    /**
     * @param array<string, FilterDto> $filters
     */
    private function __construct(private array $filters)
    {
    }

    /**
     * @param array<string, FilterDto> $filters
     */
    public static function new(array $filters = []): self
    {
        return new self($filters);
    }

    /**
     * @return array<string, FilterDto>
     */
    public function all(): array
    {
        return $this->filters;
    }

    public function get(string $filterName): ?FilterDto
    {
        return $this->filters[$filterName] ?? null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return \array_key_exists($offset, $this->filters);
    }

    public function offsetGet(mixed $offset): FilterDto
    {
        return $this->filters[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->filters[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->filters[$offset]);
    }

    public function count(): int
    {
        return \count($this->filters);
    }

    /**
     * @return \ArrayIterator<string, FilterDto>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->filters);
    }
}
