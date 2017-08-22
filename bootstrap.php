<?php
require_once('./vendor/autoload.php');
require_once('./config.php');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Init Doctrine EntityManager
$entityPath = __DIR__ . "/src/models/entities";
$paths = array($entityPath);
$metaConfig = Setup::createAnnotationMetadataConfiguration($paths, DEV_MODE);
$entityManager = EntityManager::create($config['dbParams'], $metaConfig);

// Init Slim App
$app = new \Slim\App(["settings" => $config]);
