<?php


class LogoutController extends Controller
{
    public function index($app, $data)
    {
        $app->user()->logout();

        $app->navigation()->redirect('index');
    }
}


$__controller = new LogoutController();
