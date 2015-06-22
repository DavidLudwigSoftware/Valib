<?php


class IndexController extends Controller
{
	public function index($app, $data)
	{
		$c  = $app->cookie();
		$s  = $app->session();
		$t  = $app->template();
		$cr = $app->cryptography();
		$r  = $app->request();
		$f  = $app->form();

		var_dump($f->email('email', 'test@newspawn.org'));

		$s->start();
		$s->set('test', 'test value');
		$s->destroy();
		
		$t->title('This is the title');
		$t->header1('Ths is a heading');
		$t->paragraph1('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque iure quasi dolorum libero unde accusamus esse, atque tempora corporis. Quam sint expedita velit possimus, eum laborum numquam assumenda aspernatur pariatur!');
		$t->paragraph1($s->get('test'));
		$t->javascriptHead('js/test.js');

		$t->render('index');
	}
}


$__controller = new IndexController();