<?php


class RegisterController extends Controller
{
	public function index($app, $data)
	{
		$user  = $app->user();

		if ($user->isLoggedIn())

            $app->navigation()->redirect('profile');


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
									  [$form->matches($repassword, $password, 'Passwords don\'t match'),
									   $form->unique('users', 'username', $username, 'Username is already taken'),
									   $form->unique('users', 'email', $email, 'Email is already in use')],
									   $form->token('register_token', $r->post('token')));


			if (!$result->isValid())

				foreach ($result->errorFields() as $field)

					echo $field->firstError()->message(), '<br>';

			else
			{
				date_default_timezone_set('America/Chicago');

				$user->register([$firstName->valueFormatted(),
								 $lastName->valueFormatted(),
								 $email->valueFormatted(),
								 $phone->valueFormatted(),
								 $username->valueFormatted(),
								 $password->valueFormatted(),
								 date('Y-m-d H:i:s', time()),
								 0],
								 $email->valueFormatted());
			}

		}

		$t = $app->template();

		$t->title('Register');
		$t->header1('Register');
		$t->paragraph1('Fill out the form below to register');
		$t->token($form->newToken('register_token'));

		$t->render('register.php');
	}
}


$__controller = new RegisterController();
