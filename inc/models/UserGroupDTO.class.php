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

	/**
	 * @var int[] $entities
	 */
	private array $entities;

	public function __construct()
	{
		$this->entities = [];
	}

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

	public function getEntities(): array
	{
		return $this->entities;
	}

	public function addEntities(array $entities): UserGroupDTO
	{
		$this->entities = array_unique(array_merge($this->entities, $entities));
		return $this;
	}
}
