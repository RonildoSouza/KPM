<?php

define("DEV_MODE", true);

/**
 * ENTITIES NAME
 */
define('CATEGORY_ENTITY_NAME', 'KPM\Entities\CategoryPostIt');
define('COMMENT_ENTITY_NAME', 'KPM\Entities\Comment');
define('PERMISSION_ENTITY_NAME', 'KPM\Entities\Permission');
define('POSTIT_ENTITY_NAME', 'KPM\Entities\PostIt');
define('PRIORITY_ENTITY_NAME', 'KPM\Entities\Priority');
define('PROJECT_ENTITY_NAME', 'KPM\Entities\Project');
define('STATUS_ENTITY_NAME', 'KPM\Entities\Status');
define('USER_ENTITY_NAME', 'KPM\Entities\User');
define('USERGROUP_ENTITY_NAME', 'KPM\Entities\UserGroup');

/**
 * KEYS QUERY STRING PARAM
 */
define('KEY_WITH_POSTITS', 'withPostIts');
define('KEY_WITH_CATEGORIES', 'withCategories');
define('KEY_WITH_COMMENTS', 'withComments');
define('KEY_WITH_USERS', 'withUsers');

/**
 * MESSAGES
 */
define('MSG_REGISTRY_NOT_EXIST', 'Registry does not exist!');
define('MSG_POSTIT_NOT_VALID', 'Post-it ID not valid!');
