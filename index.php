<?php

error_reporting(E_ALL | E_STRICT | E_DEPRECATED);

const INI_PATH = 'valib.ini';

require_once 'core/application.php';

new Application(INI_PATH);
