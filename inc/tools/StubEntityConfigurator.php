<?php

namespace Albatross\Tools;

require_once __DIR__ . '/EntityConfiguratorInterface.php';

class StubEntityConfigurator implements EntityConfiguratorInterface
{
    public function setupEntity(int $entityId = 0, array $params = []): bool
    {
        return 1;
    }

    public function initModules(array $neededModules): int
    {
        return 1;
    }

    public function setSecurity(): void
    {
        // TODO: Implement setSecurity() method.
    }
}