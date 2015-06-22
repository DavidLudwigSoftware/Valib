<?php

require_once 'definitions.php';
require_once 'controller.php';
require_once 'registry.php';
require_once 'router.php';

class Application
{
	private static $_instance = Null;

	public function __construct()
	{
		self::$_instance = $this;

		Router::Init($this);
	}

	public function registry()
	{
		return Registry;
	}

	public function status()
	{
		return Router::Status();
	}

	public function __call($name, $args)
	{
		$object = Registry::Get($name);

		if ($object)

			return $object;

		throw new Exception('Object not found "' . $name . '"');
	}

	public static function Instance()
	{
		return (self::$_instance) ? self::$_instance : new self();
	}
}