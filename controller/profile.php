<?php


class ProfileController extends Controller
{
    public function index($app, $data)
    {
        $user = $app->user();

        if (!$user->isLoggedIn())

            $app->navigation()->redirect('login');

        $t = $app->template();

        $username = $user->currentUser()['username'];

        $t->username($username);

        $t->render('profile.php');

    }
}


$__controller = new ProfileController();
