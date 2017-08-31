<?php
namespace  KPM\Controllers;

use \KPM\Actions\PermissionAction;

final class PermissionController implements IController
{
    /**
     * @var \KPM\Actions\PermissionAction
     */
    private $permissionAction;
    
    public function __construct(PermissionAction $permissionAction)
    {
        $this->permissionAction = $permissionAction;
    }
    
    public function getAll($request, $response, $args)
    {
        try {
            $permissions = $this->permissionAction->get();

            return $response->withJSON($permissions, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }
    
    public function getById($request, $response, $args)
    {
        try {
            $permission = $this->permissionAction->get([], $args['id']);

            return $response->withJSON($permission, 200)->withHeader('Content-type', 'application/json');
        } catch (Exception $ex) {
            return $response->withStatus(400, $ex->getMessage());
        }
    }

    public function insertOrUpdate($request, $response, $args){}

    public function delete($request, $response, $args){}
}
