<?php
namespace  KPM\Controllers;

use KPM\Actions\StatusAction;

final class StatusController extends AbstractController
{
    public function __construct(StatusAction $statusAction)
    {
        parent::__construct($statusAction);
    }
}
