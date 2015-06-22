<?php


class Session
{
	public function get($key, $default = Null)
	{
		return ($this->exists($key)) ? $_SESSION[$key] : $default;
	}

	public function set($key, $value)
	{
		if (session_status() == PHP_SESSION_NONE)

			trigger_error('Session variable set without starting the session!', E_USER_WARNING);

		$_SESSION[$key] = $value;
	}

	public function start()
	{
		session_start();
	}

	public function end()
	{
		session_destroy();
	}

	public function exists($key)
	{
		return isset($_SESSION[$key]);
	}

	public function remove($key, $path = '/')
	{
		if ($this->exists($key))
		
			unset($_SESSION[$key]);
	}

	public function clear($path = '/')
	{
		foreach (array_keys($_SESSION) as $key)
		
			$this->remove($key, $path);
	}

	public function __call($name, $args)
	{
		if (is_callable('session_' . $name))
		
			call_user_func_array('session_' . $name, $args);
		
		else

			throw new Exception('Error - session_' . $name . ' is undefined');
	}
}

$__model = new Session();