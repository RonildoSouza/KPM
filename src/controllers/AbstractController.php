<?php
namespace  KPM\Controllers;

use KPM\Actions\AbstractAction;

abstract class AbstractController
{
    /**
     * @var KPM\Actions\AbstractAction
     */
    protected $abstractAction;
    
    /**
     * Array of Query String Params
     *
     * @var array
     */
    protected $aQSP = [];

    public function __construct(AbstractAction $abstractAction)
    {
        $this->abstractAction = $abstractAction;
    }

    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $objects = $this->abstractAction->get($this->aQSP);

            return $response->withJSON($objects, 200)->withHeader('Content-type', 'application/json');
        } catch (\Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $object = $this->abstractAction->get($this->aQSP, $args['id']);

            return $response->withJSON($object, 200)->withHeader('Content-type', 'application/json');
        } catch (\Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $object = $this->abstractAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($object, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (\Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->abstractAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (\Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString) {
            $resultWithPostIts = (array_key_exists(KEY_WITH_POSTITS, $aQueryString)
                                    && strtolower($aQueryString[KEY_WITH_POSTITS]) === 'true');
            $resultWithCategories = (array_key_exists(KEY_WITH_CATEGORIES, $aQueryString)
                                    && strtolower($aQueryString[KEY_WITH_CATEGORIES]) === 'true');
            $resultWithComments = (array_key_exists(KEY_WITH_COMMENTS, $aQueryString)
                                    && strtolower($aQueryString[KEY_WITH_COMMENTS]) === 'true');
            $resultWithUsers = (array_key_exists(KEY_WITH_USERS, $aQueryString)
                                    && strtolower($aQueryString[KEY_WITH_USERS]) === 'true');

            $withPostIts = ($resultWithPostIts) ? true : false;
            $withCategories = ($resultWithCategories) ? true : false;
            $withComments = ($resultWithComments) ? true : false;
            $withUsers = ($resultWithUsers) ? true : false;

            $this->aQSP = array(
                KEY_WITH_POSTITS => $withPostIts,
                KEY_WITH_CATEGORIES => $withCategories,
                KEY_WITH_COMMENTS => $withComments,
                KEY_WITH_USERS => $withUsers,
            );
        }
    }
}
