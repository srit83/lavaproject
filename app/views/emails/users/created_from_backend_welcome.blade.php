<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>
		{{ _v('Hallo %s', array('name' => (string)$user)) }}</h1>

		<div>
		    <p>{{ _v('Es wurde ein Nutzeraccount bei %s angelegt.', array(Config::get('app.name'))) }}</p>
		    <p>{{{_('Klicke auf unten stehenden Link um dein Passwort zu vergeben.')}}}</p>
		    <p>
		    <a href="{{{URL::route('fresh_password', array($user->oneloginkey))}}}">{{{_('Passwort setzen')}}}</a>
		    </p>
		</div>
	</body>
</html>
