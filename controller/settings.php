<?php


class SettingsController extends Controller
{
    public function index($app, $data)
    {
        $app->navigation()->redirect('profile');
    }

    public function changepassword($app, $data)
    {
        $user    = $app->user();
        $session = $app->session();

        $session->start();

        if (!$user->isLoggedIn())

            $app->navigation()->redirect('index');


        $t = $app->template();

        $t->errors('');

        $form = $app->form();
        $r    = $app->request();

        if ($r->postExists('oldpassword', 'newpassword', 'reppassword', 'token'))
        {
            $oldPass = $form->text('oldpass', $r->post('oldpassword'));
            $newPass = $form->password('newpass', $r->post('newpassword'));
            $repPass = $form->text('reppass', $r->post('reppassword'));

            if (!empty($oldPass->valueFormatted()) &&
                !empty($newPass->valueFormatted()) &&
                !empty($repPass->valueFormatted()))
            {
                $result = $form->validate([$oldPass, $newPass, $repPass],
                                          [$form->matches($repPass, $newPass, "Passwords don't match")],
                                          $form->token('password_token', $r->post('token')));

                if ($result->isValid())
                {
                    $crypt = $app->cryptography();

                    if ($crypt->passwordVerify($oldPass->valueFormatted(), $user->currentUser()['password']))
                    {
                        if ($newPass->valueFormatted() !== $oldPass->valueFormatted())
                        {
                            $user->setAccountPassword($user->currentUserId(), $newPass->valueFormatted());

                            echo "Password changed successfully!";
                        }
                        else

                            echo "New password can't be the same as your current password";
                    }
                    else

                        echo "Current password is incorrect";
                }
                else {

                    foreach ($result->errorFields() as $field)

                        echo $field->firstError()->message();
                }
            }
            else

                $t->errors('Fill in the fields');
        }

        $t->token($form->newToken('password_token'));

        $t->render('settings/password.php');
    }
}

$__controller = new SettingsController();
