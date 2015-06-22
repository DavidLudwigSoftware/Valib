<?php


class Navigation
{
	public function redirect($url)
	{
		header('Location: ' . $url);
	}
}


$__model = new Navigation();