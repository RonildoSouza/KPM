<?php
namespace  KPM\Controllers;

use \KPM\Actions\CommentAction;

final class CommentController implements IController
{
    /**
     * @var \KPM\Actions\CommentAction
     */
    private $commentAction;
    
    public function __construct(CommentAction $commentAction)
    {
        $this->commentAction = $commentAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $comments = $this->commentAction->get();

            return $response->withJSON($comments, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $comment = $this->commentAction->get([], $args['id']);

            return $response->withJSON($comment, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $comment = $this->commentAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($comment, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->commentAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
}
