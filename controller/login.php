<?php


class LoginController extends Controller
{
    public function index($app, $data)
    {
        $user = $app->user();
        $nav  = $app->navigation();

        if ($user->isLoggedIn())

            $nav->redirect('profile');

        $r       = $app->request();
        $form    = $app->form();
        $t       = $app->template();
        $session = $app->session();

        $session->start();
        $t->errors('');

        if ($r->postExists('username', 'password', 'token'))
        {
            $username = $form->text('username', $r->post('username'));
            $password = $form->text('password', $r->post('password'));

            $result = $form->validate([$username, $password], [], $form->token('login_token', $r->post('token')));

            if ($result->isValid())
            {
                if ($user->login($username->valueFormatted(), $password->valueFormatted()))

                    $nav->redirect('profile');

                else

                    $t->errors('Username or password is incorrect');
            }
        }

        $t->token($form->newToken('login_token'));

        $t->render('login.php');
    }
}


$__controller = new LoginController();
