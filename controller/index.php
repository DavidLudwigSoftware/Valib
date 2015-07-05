<?php


class IndexController extends Controller
{
	public function index($app, $data)
	{
		$user = $app->user();

		if ($user->isLoggedIn())

			$app->navigation()->redirect('profile');
			

		$t = $app->template();

        $t->title("Home Page");

		$t->addMetadata("author", "David Ludwig");

		$t->render('index.php');
	}
}


$__controller = new IndexController();
