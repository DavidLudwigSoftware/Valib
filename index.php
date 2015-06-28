<?php

error_reporting(E_ALL | E_STRICT | E_DEPRECATED);

const INI_PATH = 'valib.json';

require_once 'core/application.php';

new Application(INI_PATH);
