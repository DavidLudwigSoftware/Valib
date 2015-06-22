<?php


class Registry
{
	private static $_objects = array();


	public static function Register($index, $value)
	{
		self::$_objects[$index] = $value;
	}

	public static function Get($index)
	{
		$index = strtolower($index);

		if (isset(self::$_objects[$index]))
		
			return self::$_objects[$index];

		return self::LoadModel($index);
	}

	public static function LoadModel($name)
	{
		$fileName = __SITE_PATH . '/model/' . $name;

		if (is_file($fileName . '.php'))
		
			include $fileName . '.php';
		
		elseif (is_dir($fileName))
		
			include $fileName . '/__model__.php';

		else
		{
			throw new Exception('Model could not be loaded "' . $name . '"');
			return;
		}

		if (!isset($__model))
		{
			throw new Exception('Model could not be registered "' . $name . '"');
			return;
		}

		Registry::Register($name, $__model);

		unset($__model);

		return self::Get($name);
	}

	public static function RegisteredObjects()
	{
		return self::$_objects;
	}
}