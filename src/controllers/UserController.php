<?php
namespace  KPM\Controllers;

use KPM\Actions\UserAction;

final class UserController extends AbstractController
{
    public function __construct(UserAction $userAction)
    {
        parent::__construct($userAction);
    }
}
