<?php


class MailController extends Controller
{
    public function index($app, $data)
    {
        $mail = $app->mail();
        $t    = $app->template();

        $t->message('This is an html message <a href="http://davidludwig.net">David Ludwig</a>');

        $m = $mail->create("Test Email", $t->load('email', 'test.php'));

        $m->setFrom('davidludwigii@gmail.com', 'David Ludwig');
        $m->addAddress('davidludwigii@gmail.com', 'David Ludwig');

        var_dump($m->send());
    }
}

$__controller = new MailController();
