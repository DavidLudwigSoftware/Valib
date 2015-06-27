<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{__METADATA__}
	<title>{TITLE}</title>
	{__JSHEAD__}
</head>
<body>
	<h1>{HEADER1}</h1>
	<p>{PARAGRAPH1}</p>
	<form action="" method="post">
		<span>First Name</span>
		<input type="text" name="firstname" value="<?php echo Application::Instance()->request()->post('firstname'); ?>"><br><br>
		<span>Last Name</span>
		<input type="text" name="lastname" value="<?php echo Application::Instance()->request()->post('lastname'); ?>"><br><br>
		<span>Email</span>
		<input type="text" name="email" value="<?php echo Application::Instance()->request()->post('email'); ?>"><br><br>
		<span>Phone</span>
		<input type="text" name="phone" value="<?php echo Application::Instance()->request()->post('phone'); ?>"><br><br>
		<span>Username</span>
		<input type="text" name="username" value="<?php echo Application::Instance()->request()->post('username'); ?>"><br><br>
		<span>Password</span>
		<input type="password" name="password" value="<?php echo Application::Instance()->request()->post('password'); ?>"><br><br>
		<span>Confirm Password</span>
		<input type="password" name="repassword" value="<?php echo Application::Instance()->request()->post('repassword'); ?>"><br><br>
		<input type="submit" value="Register">
	</form>
	{__JSBODY__}
</body>
</html>