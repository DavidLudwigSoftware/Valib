<?php


class RegisterController extends Controller
{
	public function index($app, $data)
	{
		$db = $app->database();
		if ($app->request()->postExists('firstname', 'lastname',
										'email', 'phone', 'username',
										'password', 'repassword'))
		{
			$r    = $app->request();
			$form = $app->form();

			$firstName  = $form->name('firstname',      $r->post('firstname'));
			$lastName   = $form->name('lastname',       $r->post('lastname'));
			$email      = $form->email('email',         $r->post('email'));
			$phone      = $form->phoneNumber('phone',   $r->post('phone'));
			$username   = $form->username('username',   $r->post('username'));
			$password   = $form->password('password',   $r->post('password'));
			$repassword = $form->password('repassword', $r->post('repassword'));

			$result = $form->validate([$firstName, $lastName, $email, $phone, $username, $password, $repassword],
									  [$form->matches($repassword, $password, 'Passwords don\'t match')]);

			if (!$result->isValid())

				foreach ($result->errorFields() as $field)

					echo $field->firstError()->message(), '<br>';
		}

		$t = $app->template();

		$t->title('Register');
		$t->header1('Register');
		$t->paragraph1('Fill out the form below to register');

		$t->render('register');
	}
}


$__controller = new RegisterController();
