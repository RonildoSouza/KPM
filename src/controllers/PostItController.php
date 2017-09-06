<?php
namespace  KPM\Controllers;

use KPM\Actions\PostItAction;

final class PostItController implements IController
{
    /**
     * @var KPM\Actions\PostItAction
     */
    private $postItAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(PostItAction $postItAction)
    {
        $this->postItAction = $postItAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $postIts = $this->postItAction->get($this->aQSP);

            return $response->withJSON($postIts, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $postIt = $this->postItAction->get($this->aQSP, $args['id']);

            return $response->withJSON($postIt, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $postIt = $this->postItAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($postIt, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
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

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->postItAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString && array_key_exists('withComments', $aQueryString)) {
            $withComments = (strtolower($aQueryString['withComments']) === 'true') ? true : false;
            $this->aQSP = array(
                'withComments' => $withComments
            );
        }
    }
}
