<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{__METADATA__}
	<title>{TITLE}</title>
	{__STYLESHEETS__}
	{__JSHEAD__}
</head>
<body>
	<h1>{HEADER1}</h1>
	<p>{PARAGRAPH1}</p>
	<form action="" method="post" enctype="multipart/form-data">
		<span>First Name</span>
		<input type="text" name="firstname" value="{__POST__:firstname}"><br><br>
		<span>Last Name</span>
		<input type="text" name="lastname" value="{__POST__:lastname}"><br><br>
		<span>Email</span>
		<input type="text" name="email" value="{__POST__:email}"><br><br>
		<span>Phone</span>
		<input type="text" name="phone" value="{__POST__:phone}"><br><br>
		<span>Username</span>
		<input type="text" name="username" value="{__POST__:username}"><br><br>
		<span>Password</span>
		<input type="password" name="password" value="{__POST__:password}"><br><br>
		<span>Confirm Password</span>
		<input type="password" name="repassword" value="{__POST__:repassword}"><br><br>
		<input type="submit" value="Register">
	</form>
	{__JSBODY__}
</body>
</html>
