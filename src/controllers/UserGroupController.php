<?php
namespace  KPM\Controllers;

use KPM\Actions\UserGroupAction;

final class UserGroupController implements IController
{
    /**
     * @var KPM\Actions\UserGroupAction
     */
    private $userGroupAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(UserGroupAction $userGroupAction)
    {
        $this->userGroupAction = $userGroupAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $userGroups = $this->userGroupAction->get($this->aQSP);

            return $response->withJSON($userGroups, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $userGroup = $this->userGroupAction->get($this->aQSP, $args['id']);

            return $response->withJSON($userGroup, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $userGroup = $this->userGroupAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($userGroup, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->userGroupAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString && array_key_exists('withUsers', $aQueryString)) {
            $withUsers = (strtolower($aQueryString['withUsers']) === 'true') ? true : false;
            $this->aQSP = array(
                'withUsers' => $withUsers
            );
        }
    }
}
