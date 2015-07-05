<?php


class Navigation
{
	private $_baseUrl;

	public function __construct()
	{
		$this->_baseUrl = Application::Instance()->configuration()['navigation']['baseurl'];
	}

	public function redirect($url)
	{
		header('Location: ' . $url);
		exit();
	}

	public function build($baseUrl, $page, $args = [])
	{
		$url = rtrim($baseUrl, '/') . '/' . $page;

		$i = 0;
		foreach ($args as $key => $value)
		{
			$url .= (($i == 0) ? '?' : '&') . urlencode($key) . '=' . urlencode($value);
			$i++;
		}

		return $url;
	}

	public function baseUrl() { return $this->_baseUrl; }
}


$__model = new Navigation();
