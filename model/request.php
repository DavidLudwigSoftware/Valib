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

	public function file($key)
	{
		if (isset($_FILES[$key]))

			if ($_FILES[$key]['error'] !== UPLOAD_ERR_NO_FILE)

				return new FileObject($_FILES[$key]);

		return Null;
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

	public function fileExists(...$keys)
	{
		foreach ($keys as $key)

			if (!isset($_FILES[$key]) || $_FILES[$key]['error'] === UPLOAD_ERR_NO_FILE)

				return False;

		return True;
	}
}


class FileObject
{
	private $_name;
	private $_type;
	private $_tmpName;
	private $_error;
	private $_size;


	public function __construct($fileArray)
	{
		$this->_name    = $fileArray['name'];
		$this->_type    = $fileArray['type'];
		$this->_tmpName = $fileArray['tmp_name'];
		$this->_error   = $fileArray['error'];
		$this->_size    = $fileArray['size'];
	}

	public function name()
	{
		return $this->_name;
	}

	public function type()
	{
		return $this->_type;
	}

	public function tempName()
	{
		return $this->_tmpName;
	}

	public function error()
	{
		return $this->_error;
	}

	public function size()
	{
		return $this->_size;
	}

	public function ext()
	{
		return pathinfo($this->_name, PATHINFO_EXTENSION);
	}

	public function hasError()
	{
		return boolval($this->_error == UPLOAD_ERR_OK);
	}

	public function move($filePath)
	{
		return move_uploaded_file($this->_tmpName, $filePath);
	}

	public function generateName($length = 32)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
		$name = '';

		for ($i = 0; $i < $length; $i++)

			$name .= $chars[rand(0, strlen($chars) - 1)];

		return $name . '.' . $this->ext();
	}
}

$__model = new Request();
