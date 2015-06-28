<?php


class IndexController extends Controller
{
	public function index($app, $data)
	{
		$db = $app->database();

		$t = $app->template();

        $t->title("Home Page");

		$t->render('index');
	}
}


$__controller = new IndexController();
