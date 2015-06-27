<?php


define('SITE_PATH',  realpath(dirname(PHP_EOL)));
define('VIEW_PATH',  SITE_PATH . '/view');
define('MODEL_PATH', SITE_PATH . '/model');

define('STATUS_SUCCESS', 200);

define('STATUS_INTERNAL_SERVER_ERROR', 500);
define('STATUS_FORBIDDEN', 403);
define('STATUS_NOT_FOUND', 404);
