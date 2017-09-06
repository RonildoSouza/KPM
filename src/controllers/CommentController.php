<?php
namespace  KPM\Controllers;

use KPM\Actions\CommentAction;

final class CommentController extends AbstractController
{
    public function __construct(CommentAction $commentAction)
    {
        parent::__construct($commentAction);
    }
}
