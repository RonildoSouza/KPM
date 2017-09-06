<?php
namespace  KPM\Controllers;

use KPM\Actions\UserGroupAction;

final class UserGroupController extends AbstractController
{
    public function __construct(UserGroupAction $userGroupAction)
    {
        parent::__construct($userGroupAction);
    }
}
