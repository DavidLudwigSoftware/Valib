<?php


class Form
{
	private static $_fields;

	public function validate($fields, $rules)
	{
		
	}

	public function __call($name, $args)
	{
		$name = strtolower($name);
		
		if (isset(self::$_fields[$name]))
		{
			$class = self::$_fields[$name];
			
			return new $class(...$args);
		}
	}

	public static function RegisterField($object)
	{
		$className = strtolower(substr($object, 0, strlen($object) - 5));

		self::$_fields[$className] = $object;
	}
}
