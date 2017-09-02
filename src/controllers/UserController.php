<?php
namespace  KPM\Controllers;

use KPM\Actions\UserAction;

final class UserController implements IController
{
    /**
     * @var KPM\Actions\UserAction
     */
    private $userAction;

    /**
     * Array of Query String Params
     *
     * @var array
     */
    private $aQSP = [];
    
    public function __construct(UserAction $userAction)
    {
        $this->userAction = $userAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $users = $this->userAction->get($this->aQSP);

            return $response->withJSON($users, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $this->setValueQueryParams($request);

            $user = $this->userAction->get($this->aQSP, $args['id']);

            return $response->withJSON($user, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args)
    {
        try {
            $id = array_key_exists('id', $args) ? (int)$args['id'] : 0;
            $jsonObj = $request->getParsedBody();
            $user = $this->userAction->postOrPut($jsonObj, $id);

            $statusCode = $request->isPost() ? 201 : 200;
            return $response->withJSON($user, $statusCode)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function delete($request, $response, $args)
    {
        try {
            $result = $this->userAction->delete((int)$args['id']);

            $statusCode = $result ? 200 : 204;
            return $response->withStatus($statusCode);
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    private function setValueQueryParams($request)
    {
        $aQueryString = $request->getQueryParams();
        
        if ($aQueryString) {
            $keyWithPostIts = 'withPostIts';
            $keyWithComments = 'withComments';

            $resultWithPostIts = (array_key_exists($keyWithPostIts, $aQueryString)
                                    && strtolower($aQueryString[$keyWithPostIts]) === 'true');
            $resultWithComments = (array_key_exists($keyWithComments, $aQueryString)
                                    && strtolower($aQueryString[$keyWithComments]) === 'true');

            $withPostIts = ($resultWithPostIts) ? true : false;
            $withComments = ($resultWithComments) ? true : false;

            $this->aQSP = array(
                $keyWithPostIts => $withPostIts,
                $keyWithComments => $withComments
            );
        }
    }
}
