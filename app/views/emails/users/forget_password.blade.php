<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>
		{{ _v('Hallo %s', array('name' => (string)$user)) }}</h1>

		<div>
		    <p>{{{_('Es wurde ein Link zum ändern deines Passwortes angefordert. Klicke auf unten stehenden Link, um dein Passwort zu ändern.')}}}
		    <br>

		    <a href="{{{URL::route('fresh_password', array($user->oneloginkey))}}}">{{{_('Passwort setzen')}}}</a>
		    </p>
		</div>
	</body>
</html>
