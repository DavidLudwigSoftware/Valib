<?php

error_reporting(E_ALL | E_STRICT | E_DEPRECATED);

const CONFIG_FILE = 'valib.json';

require_once 'core/application.php';

new Application(CONFIG_FILE);
