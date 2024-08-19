<?php

namespace Albatross;

class TicketDTO
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $creationDate;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): TicketDTO
    {
        $this->subject = $subject;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): TicketDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): TicketDTO
    {
        $this->creationDate = $creationDate;
        return $this;
    }
}
