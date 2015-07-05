<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{TITLE}</title>
    </head>
    <body>
        <form action="" method="post">
            <p>
                {ERRORS}
            </p>
            <label for="username">Email or Username</label><br>
            <input type="text" id="username" name="username" value="{__POST__:username}"><br><br>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" value=""><br><br>
            <input type="submit" name="name" value="Sign In">
            <input type="hidden" name="token" value="{TOKEN}">
        </form>
    </body>
</html>
