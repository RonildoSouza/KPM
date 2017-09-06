<?php
namespace  KPM\Controllers;

use KPM\Actions\PermissionAction;

final class PermissionController extends AbstractController
{
    public function __construct(PermissionAction $permissionAction)
    {
        parent::__construct($permissionAction);
    }
}
