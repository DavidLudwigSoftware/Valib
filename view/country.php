<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    	{__METADATA__}
    	<title>{TITLE}</title>
    	{__STYLESHEETS__}
    	{__JSHEAD__}
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="country" value="<?php echo Application::Instance()->request()->post('country'); ?>">
            <input type="submit" value="Add Country">
        </form>
    </body>
</html>
