<?php


class Configuration implements ArrayAccess
{
	private static $_instance;


	private $_container = array();


	public function __construct($array)
	{
		$this->_container = $array;
		self::$_instance  = $this;
	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset))
			$this->_container[] = $value;

		else
			$this->_container[$offset] = $value;

	}

	public function offsetExists($offset)
	{
		return isset($this->_container[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->_container[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->_container[$offset]) ? $this->_container[$offset] : Null;
	}

	public static function Init($configPath)
	{
		new self(json_decode(file_get_contents($configPath), True));
	}

	public static function Instance()
	{
		return self::$_instance;
	}
}
