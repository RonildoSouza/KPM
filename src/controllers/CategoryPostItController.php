<?php
namespace  KPM\Controllers;

use KPM\Actions\CategoryPostItAction;

final class CategoryPostItController extends AbstractController
{    
    public function __construct(CategoryPostItAction $categoryAction)
    {
        parent::__construct($categoryAction);
    }
}
