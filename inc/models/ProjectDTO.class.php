<?php

namespace Albatross;

class ProjectDTO
{
    private string $label;

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): ProjectDTO
    {
        $this->label = $label;
        return $this;
    }
}
