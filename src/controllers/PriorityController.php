<?php
namespace  KPM\Controllers;

use KPM\Actions\PriorityAction;

final class PriorityController extends AbstractController
{
    public function __construct(PriorityAction $priorityAction)
    {
        parent::__construct($priorityAction);
    }
}
