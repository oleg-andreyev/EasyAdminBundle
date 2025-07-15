<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Contracts\Provider;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;

interface FieldProviderInterface
{
    /**
     * @return FieldCollection<FieldInterface>
     */
    public function createCollection(iterable $fields): FieldCollection;

    /**
     * @return array<FieldInterface>
     */
    public function getDefaultFields(string $pageName): array;
}
