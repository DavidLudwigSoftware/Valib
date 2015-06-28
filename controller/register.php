<?php


class RegisterController extends Controller
{
	public function index($app, $data)
	{
		$r  = $app->request();

		if ($r->postExists('firstname', 'lastname',
							'email', 'phone', 'username',
							'password', 'repassword') &&
			$r->fileExists('image'))
		{
			$db    = $app->database();
			$form  = $app->form();
			$crypt = $app->cryptography();

			$file = $r->file('image');

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

			$file->move(UPLOAD_PATH . '/' . $file->generateName());
		}

		$t = $app->template();

		$t->title('Register');
		$t->header1('Register');
		$t->paragraph1('Fill out the form below to register');

		$t->render('register');
	}
}


$__controller = new RegisterController();
