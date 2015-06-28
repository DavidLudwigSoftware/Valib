<?php

require_once MODEL_PATH . '/form/form.php';
require_once MODEL_PATH . '/form/formerror.php';
require_once MODEL_PATH . '/form/formresult.php';

require_once MODEL_PATH . '/form/fields/formfield.php';
require_once MODEL_PATH . '/form/fields/email.php';
require_once MODEL_PATH . '/form/fields/float.php';
require_once MODEL_PATH . '/form/fields/integer.php';
require_once MODEL_PATH . '/form/fields/ipaddress.php';
require_once MODEL_PATH . '/form/fields/macaddress.php';
require_once MODEL_PATH . '/form/fields/name.php';
require_once MODEL_PATH . '/form/fields/password.php';
require_once MODEL_PATH . '/form/fields/phonenumber.php';
require_once MODEL_PATH . '/form/fields/regularexpression.php';
require_once MODEL_PATH . '/form/fields/text.php';
require_once MODEL_PATH . '/form/fields/url.php';
require_once MODEL_PATH . '/form/fields/username.php';

require_once MODEL_PATH . '/form/rules/formrule.php';
require_once MODEL_PATH . '/form/rules/matches.php';

$__model = new Form();
