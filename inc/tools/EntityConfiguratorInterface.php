<?php

namespace Albatross\Tools;

interface EntityConfiguratorInterface
{
    public function setupEntity(int $entityId = 0, array $params = []): bool;

    public function initModules(array $neededModules): int;

    public function setSecurity(): void;
}
