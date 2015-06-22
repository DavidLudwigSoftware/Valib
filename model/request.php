<?php


class Request
{
	public function get($key, $default = Null)
	{
		return (isset($_GET[$key])) ? $_GET[$key] : $default;
	}

	public function post($key, $default = Null)
	{
		return (isset($_POST[$key])) ? $_POST[$key] : $default;
	}

	public function getExists(...$keys)
	{
		foreach ($keys as $key)

			if (!isset($_GET[$key]))

				return False;

		return True;
	}

	public function postExists(...$keys)
	{
		foreach ($keys as $key)

			if (!isset($_POST[$key]))

				return False;

		return True;
	}
}

$__model = new Request();