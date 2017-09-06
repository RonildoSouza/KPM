<?php
namespace  KPM\Controllers;

use KPM\Actions\ProjectAction;

final class ProjectController extends AbstractController
{
    public function __construct(ProjectAction $projectAction)
    {
        parent::__construct($projectAction);
    }
}
