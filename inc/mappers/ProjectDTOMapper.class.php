<?php

namespace Albatross;

use Albatross\Project;
use Albatross\ProjectDTO;

include_once dirname(__DIR__) . '/models/ProjectDTO.class.php';
require_once dirname(__DIR__, 4) . '/projet/class/project.class.php';

class ProjectDTOMapper
{
    public function toProjectDTO(\Project $project): ?ProjectDTO
    {
        if(is_null($project->title)) {
            return null;
        }

        $projectDTO = new ProjectDTO();
        $projectDTO
            ->setLabel($project->title);

        return $projectDTO;
    }

    public function toProject(ProjectDTO $projectDTO): \Project
    {
        global $db;
        $project = new \Project($db);

        $project->ref = uniqid();
        $project->title = $projectDTO->getLabel();

        return $project;
    }

    public function toProjectWithTasks($projectDTO): \Project
    {
        global $db;
        $project = new \Project($db);

        $project->ref = uniqid();
        $project->title = $projectDTO->getLabel();
        $project->usage_task = 1;

        return $project;
    }
}
