<?php

class Router
{
	private static $_url;
	private static $_file;
	private static $_data;
	private static $_action;
	private static $_controller;
	private static $_status = STATUS_SUCCESS;


	public static function Init($app)
	{
		self::InitUrl();
		self::ProcessUrl();
		self::InitController();
		self::Execute($app);
	}


	protected static function InitUrl()
	{
		$url = trim((isset($_GET['vmvcrt'])) ? $_GET['vmvcrt'] : 'index');

		self::$_url = (empty($url)) ? 'index' : $url;
	}


	protected static function ProcessUrl()
	{
		$data = '';

		if (strpos(self::$_url, '/') !== False)
		{
			$file   = trim(substr(self::$_url, 0, strpos(self::$_url, '/')));
			$action = trim(substr(self::$_url, strpos(self::$_url, '/') + 1));

			if (strpos($action, '/') !== False)
			{
				$data   = trim(substr($action, strpos($action, '/') + 1));
				$action = trim(substr($action, 0, strpos($action, '/')));
			}
		}
		else
		{
			$file   = self::$_url;
			$action = 'index';
			$data   = '';
		}

		self::$_file   = (empty($file)) ? 'index' : $file;
		self::$_action = (empty($action)) ? 'index' : $action;
		self::$_data   = $data;
	}


	protected static function InitController()
	{
		$file = SITE_PATH . '/controller/' . strtolower(self::$_file) . '.php';

		if (is_file($file))
		{
			include $file;

			if (isset($__controller))
			{
				self::$_controller = $__controller;
				Registry::Register('controller', self::$_controller);
			}

			else

				self::$_status = STATUS_INTERNAL_SERVER_ERROR;
		}
		else

			self::$_status = STATUS_NOT_FOUND;
	}


	protected static function Execute($app)
	{
		if (is_callable(array(self::$_controller, self::$_action)))
		{
			$action = self::$_action;
			self::$_controller->$action($app, self::$_data);
		}
		else

			self::$_status = STATUS_NOT_FOUND;
	}

	public static function SetStatus($status)
	{
		self::$_status = $status;
	}

	public static function Url() { return self::$_url; }
	public static function File() { return self::$_file; }
	public static function Data() { return self::$_data; }
	public static function Action() { return self::$_action; }
	public static function Status() { return self::$_status; }
	public static function Controller() { return self::$_controller; }
}
