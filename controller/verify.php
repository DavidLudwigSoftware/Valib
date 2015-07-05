<?php


class VerifyController extends Controller
{
    public function index($app, $data)
    {
        $r   = $app->request();
        $nav = $app->navigation();

        if ($r->getExists('id'))
        {
            $link = $r->get('id');
            $user = $app->user();

            if ($user->verifyAccount($link))

                $nav->redirect('login');

        }

        $nav->redirect('index');
    }
}


$__controller = new VerifyController();
