<?php


define('__SITE_PATH',  realpath(dirname(PHP_EOL)));
define('__MODEL_PATH', __SITE_PATH . '/model');

define('STATUS_SUCCESS', 200);

define('STATUS_INTERNAL_SERVER_ERROR', 500);
define('STATUS_FORBIDDEN', 403);
define('STATUS_NOT_FOUND', 404);