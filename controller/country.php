<?php


class CountryController extends Controller
{
	public function index($app, $data)
	{
        $r = $app->request();

        if ($r->postExists('country'))
        {
            $db = $app->database();
            $form = $app->form();

            $country = $form->name('country', $r->post('country'));

            $result = $form->validate([$country], [$form->unique($db, 'country', ['country'], $country)]);

            if ($result->isValid())
            {
                $db->insert('country', [$country->valueFormatted(), Null]);
                echo "Country Added!<br>";
            }
            else {
                foreach ($result->errorFields() as $field)
                    echo $field->firstError()->message(), '<br>';
            }
        }

		$t = $app->template();

        $t->title("Register a country");

		$t->render('country');
	}
}


$__controller = new CountryController();
