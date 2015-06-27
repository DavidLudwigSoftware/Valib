<?php


class Form
{
	const VALID   = 0x0;
	const INVALID = 0x1;
	const VOID    = 0x2;
	const SHORT   = 0x3;
	const LONG    = 0x4;
	const SMALL   = 0x5;
	const LARGE   = 0x6;
	const OTHER   = 0x7;

	const PASSWORD_STANDARD   = 0x0;
	const PASSWORD_MIXED_CASE = 0x1;
	const PASSWORD_NUMBERS    = 0x2;
	const PASSWORD_SYMBOLS    = 0x4;

	private static $_fields;

	public function validate($fields, $rules = [])
	{
		$formResult = new FormResult();

		foreach ($fields as $field)
		{
			$result = $field->validate();
			
			if (!empty($result))

				$formResult->addError($field->id(), $result);
		}

		return $formResult;
	}

	public function __call($name, $args)
	{
		$name = strtolower($name);
		
		if (isset(self::$_fields[$name]))
		{
			$class = self::$_fields[$name];
			
			return new $class(...$args);
		}
		else

			throw new Exception($name . ' is not a valid field');
	}

	public static function RegisterField($object)
	{
		$className = strtolower(substr($object, 0, strlen($object) - 5));

		self::$_fields[$className] = $object;
	}
}
