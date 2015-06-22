<?php

require_once __MODEL_PATH . '/form/form.php';

require_once __MODEL_PATH . '/form/fields/formfield.php';
require_once __MODEL_PATH . '/form/fields/email.php';
require_once __MODEL_PATH . '/form/fields/float.php';
require_once __MODEL_PATH . '/form/fields/integer.php';
require_once __MODEL_PATH . '/form/fields/ipaddress.php';
require_once __MODEL_PATH . '/form/fields/macaddress.php';
require_once __MODEL_PATH . '/form/fields/name.php';
require_once __MODEL_PATH . '/form/fields/password.php';
require_once __MODEL_PATH . '/form/fields/phonenumber.php';
require_once __MODEL_PATH . '/form/fields/regularexpression.php';
require_once __MODEL_PATH . '/form/fields/text.php';
require_once __MODEL_PATH . '/form/fields/url.php';
require_once __MODEL_PATH . '/form/fields/username.php';

$__model = new Form();