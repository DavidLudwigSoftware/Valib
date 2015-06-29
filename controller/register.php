<?php


class RegisterController extends Controller
{
	public function index($app, $data)
	{
		$s = $app->session();
		$s->start();

		$r  = $app->request();
		$form  = $app->form();

		if ($r->postExists('firstname', 'lastname',
							'email', 'phone', 'username',
							'password', 'repassword', 'token'))
		{
			$db    = $app->database();
			$crypt = $app->cryptography();

			$firstName  = $form->name('firstname',      $r->post('firstname'));
			$lastName   = $form->name('lastname',       $r->post('lastname'));
			$email      = $form->email('email',         $r->post('email'));
			$phone      = $form->phoneNumber('phone',   $r->post('phone'));
			$username   = $form->username('username',   $r->post('username'));
			$password   = $form->password('password',   $r->post('password'));
			$repassword = $form->password('repassword', $r->post('repassword'));

			$result = $form->validate([$firstName, $lastName, $email, $phone, $username, $password, $repassword],
									  [$form->matches($repassword, $password, 'Passwords don\'t match')],
									   $form->token('register_token', $r->post('token')));

			if ($result === $form::ERROR_INVALID_TOKEN)

				echo "Invalid token";

			elseif (!$result->isValid())

				foreach ($result->errorFields() as $field)

					echo $field->firstError()->message(), '<br>';
		}

		$t = $app->template();

		$t->title('Register');
		$t->header1('Register');
		$t->paragraph1('Fill out the form below to register');
		$t->token($form->newToken('register_token'));

		$t->render('register');
	}
}


$__controller = new RegisterController();
