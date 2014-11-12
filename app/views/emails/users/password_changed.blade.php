<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>
		{{ _v('Hallo %s', array('name' => (string)$user)) }}</h1>

		<div>
		    <p>{{{_('dein Passwort wurde gerade geändert. Sollte dies ohne dein Tun getan worden sein, ändere dein Passwort bitte umgehend. Wie das funktioniert, erfährst du unter folgendem Link:')}}}
		    <br>
		    <a href="{{{URL::route('forget_password')}}}">{{{_('Einen neuen Passwort Link anfordern.')}}}</a>
		    </p>
		</div>
	</body>
</html>
