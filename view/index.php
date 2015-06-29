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
        <a href="register">Register</a>
        {__INCLUDE__:widgets/test.php}
        <br><br>
        {__GET__:test~hello world, isn't this great}

        {__JSBODY__}
    </body>
</html>
