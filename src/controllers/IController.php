<?php
namespace  KPM\Controllers;

interface IController
{
    public function getAll($request, $response, $args);
    public function getById($request, $response, $args);
    public function insertOrUpdate($request, $response, $args);
    public function delete($request, $response, $args);    
}
