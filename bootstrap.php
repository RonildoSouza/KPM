<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/src/constants.php');
require_once(__DIR__ . '/config.php');

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Init Doctrine EntityManager
 */
$entityPath = __DIR__ . "/src/models/entities";
$paths = array($entityPath);
$metaConfig = Setup::createAnnotationMetadataConfiguration($paths, DEV_MODE);
$entityManager = EntityManager::create($config['dbParams'], $metaConfig);

/**
 * Init Slim App
 */
$app = new \Slim\App(["settings" => $config]);
