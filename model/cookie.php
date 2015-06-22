<?php


class Cookie
{
	public function get($key, $default = Null)
	{
		return ($this->exists($key)) ? $_COOKIE[$key] : $default;
	}

	public function set($key, $value, $expire = 0, $path = '/', $domain = Null, $secure = False, $httponly = False)
	{
		setcookie($key, $value, $expire, $path, $domain, $secure, $httponly);

		return $value;
	}

	public function exists($key)
	{
		return isset($_COOKIE[$key]);
	}

	public function remove($key, $path = '/')
	{
		if ($this->exists($key))
		{
			unset($_COOKIE[$key]);

			setcookie($key, Null, -1, $path);
		}
	}

	public function clear($path = '/')
	{
		foreach (array_keys($_COOKIE) as $key)
		
			$this->remove($key, $path);
	}
}

$__model = new Cookie();