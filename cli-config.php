<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once("bootstrap.php");

if (DEV_MODE) {
    // Register EntityManager in the CLI
    return ConsoleRunner::createHelperSet($entityManager);
}

/**
 *                 COMMANDS CLI
 *
 * > vendor/bin/doctrine orm:schema-tool:create
 * > vendor/bin/doctrine orm:schema-tool:drop --force
 * > vendor/bin/doctrine orm:schema-tool:create
 * > vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
 *
 */
