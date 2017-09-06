<?php
namespace  KPM\Controllers;

use KPM\Actions\PostItAction;

final class PostItController extends AbstractController
{
    /**
     * @var KPM\Actions\PostItAction
     */
    private $postItAction;
    
    public function __construct(PostItAction $postItAction)
    {
        parent::__construct($postItAction);
        $this->postItAction = $postItAction;
    }

    public function modifyStatus($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $postIt = $this->postItAction->changeStatus($jsonObj, $id);

            return $response->withJSON($postIt, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
}
