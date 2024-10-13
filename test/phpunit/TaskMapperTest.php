<?php

namespace test\functional;

// Prepare the environment
if (!defined('TEST_ENV_SETUP')) {
    require_once dirname(__FILE__) . '/_setup.php';
}

require_once dirname(__DIR__, 2) . '/inc/mappers/TaskDTOMapper.class.php';

use Albatross\TaskDTOMapper;

use DateTime;
use Exception;
use PHPUnit\Framework\TestCase;
use Task;

class TaskMapperTest extends TestCase
{
    public function testTaskDTOMapperConvertsToTaskDTO()
    {
        global $db;
        $task = new Task($db); // Assuming you have a Task class defined
        $task->label = 'Test Task';
        $task->description = 'Test Task Description';
        $task->datee = time() + 3600 * 24; // Set due date to 1 day from now

        $mapper = new TaskDTOMapper();
        $taskDTO = $mapper->toTaskDTO($task);

        $this->assertEquals('Test Task', $taskDTO->getTitle());
        $this->assertEquals('Test Task Description', $taskDTO->getDescription());
        $this->assertEquals((new DateTime())->setTimestamp($task->datee), $taskDTO->getDueDate());
    }

    public function testTaskDTOMapperHandlesEmptyTask()
    {
        global $db;
        $task = new Task($db); // Create an empty Task object

        $mapper = new TaskDTOMapper();

        $this->expectException(Exception::class);
        $taskDTO = $mapper->toTaskDTO($task); // Assuming this method throws an exception for empty tasks
    }
}
