<?php

namespace Albatross;

class UserGroupDTO
{
    /**
     * @var ?int id
     */
    private $id;

    /**
     * @var string label
     */
    private $label;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): UserGroupDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): UserGroupDTO
    {
        $this->label = $label;
        return $this;
    }
}
