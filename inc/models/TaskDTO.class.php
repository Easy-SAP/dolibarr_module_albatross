<?php

namespace Albatross;


class TaskDTO
{
    private $title;
    private $description;
    private $dueDate;

    public function __construct()
    {
        $this->dueDate = new \DateTime(); // Default to now
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): TaskDTO
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): TaskDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): TaskDTO
    {
        $this->dueDate = $dueDate;
        return $this;
    }
}
