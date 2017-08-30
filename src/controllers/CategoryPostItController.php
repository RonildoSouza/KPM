<?php
namespace  KPM\Controllers;

final class CategoryPostItController
{
    /**
     * @var \KPM\Actions\CategoryPostItAction
     */
    private $categoryAction;
    
    public function __construct(\KPM\Actions\CategoryPostItAction $categoryAction)
    {
        $this->categoryAction = $categoryAction;
    }

    // public function test($request, $response, $args)
    // {
    //     var_dump($this->categoryAction);
    //     return $response;
    // }
    
    public function getAll($request, $response, $args)
    {
        try
        {
            $categories = $this->categoryAction->get();
            // $json = json_encode($categories->fetchArray());

            var_dump($categories);

            return $response;//->withJSON($json);
        }
        catch(Exception $ex)
        {
            return $response->withStatus(500, $ex->message());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try
        {
            $category = $this->categoryAction->get($args['id']);

            var_dump($category);

            return $response->withJSON($category);
        }
        catch(Exception $ex)
        {
            return $response->withStatus(500, $ex->message());
        }        
    }    
}