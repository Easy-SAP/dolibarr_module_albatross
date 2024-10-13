<?php

namespace Albatross;

include_once dirname(__DIR__) . '/models/TaskDTO.class.php';
require_once dirname(__DIR__, 4) . '/projet/class/task.class.php';

use Albatross\TaskDTO;

class TaskDTOMapper
{
    public function toTask(TaskDTO $taskDTO): \Task
    {
        global $db;

        $task = new \Task($db);

        $task->ref = uniqid();
        $task->label = $taskDTO->getTitle();
        $task->description = $taskDTO->getDescription();
        $task->datee = $taskDTO->getDueDate()->getTimestamp();

        return $task;
    }

    public function toTaskDTO(\Task $task): TaskDTO
    {
        $requiredFields = ['label', 'description', 'datee'];
        foreach ($requiredFields as $field) {
            if (!isset($task->$field)) {
                throw new \Exception("Missing required field: $field");
            }
        }

        $taskDTO = new TaskDTO();
        $taskDTO
            ->setTitle($task->label)
            ->setDescription($task->description)
            ->setDueDate((new \DateTime())->setTimestamp($task->datee));

        return $taskDTO;
    }
}
