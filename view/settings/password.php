<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Change you password</title>
    </head>
    <body>
        <form action="" method="post">
            <p>{ERRORS}</p>
            <input type="password" name="oldpassword" placeholder="Current password..."><br><br>
            <input type="password" name="newpassword" placeholder="New password..."><br><br>
            <input type="password" name="reppassword" placeholder="Repeat password..."><br><br>
            <input type="submit">
            <input type="hidden" name="token" value="{TOKEN}">
        </form>
    </body>
</html>
