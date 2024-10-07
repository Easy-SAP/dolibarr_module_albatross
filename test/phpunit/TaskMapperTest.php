<?php

namespace test\functional;

define('DOL_DOCUMENT_ROOT', dirname(__DIR__, 4));
require_once dirname(__DIR__, 2) . '/inc/mappers/TaskDTOMapper.class.php';
require_once dirname(__DIR__, 2) . '/inc/models/Task.class.php'; // Include your Task model

use PHPUnit\Framework\TestCase;

class TaskMapperTest extends TestCase
{
	public function testTaskDTOMapperConvertsToTaskDTO()
	{
		global $db;
		$task = new \Task($db); // Assuming you have a Task class defined
		$task->label = 'Test Task';
		$task->description = 'Test Task Description';
		$task->dueDate = time() + 3600 * 24; // Set due date to 1 day from now

		$mapper = new \Albatross\TaskDTOMapper();
		$taskDTO = $mapper->toTaskDTO($task);

		$this->assertEquals('Test Task', $taskDTO->getTitle());
		$this->assertEquals('Test Task Description', $taskDTO->getDescription());
		$this->assertEquals((new \DateTime())->setTimestamp($task->dueDate), $taskDTO->getDueDate());
	}

	public function testTaskDTOMapperHandlesEmptyTask()
	{
		global $db;
		$task = new \Task($db); // Create an empty Task object

		$mapper = new \Albatross\TaskDTOMapper();

		$this->expectException(\Exception::class);
		$taskDTO = $mapper->toTaskDTO($task); // Assuming this method throws an exception for empty tasks
	}
}
