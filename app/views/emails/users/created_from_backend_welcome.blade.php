<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>
		<?= __('Hallo :name', array('name' => (string)$user)) ?></h1>

		<div>
		    <p><?= __('Es wurde ein Nutzeraccount bei :url angelegt.') ?><br><?= __('Nach deinem ersten Login, wirst du aufgefordert dein Passwort neu zu setzen.') ?></p>
		    <p>
		    <?= __('Deine vorläufigen Zugangsdaten')?>:
		    </p>
		    <p>
		    <?= __('Login') ?>: {{{$user->email}}}<br>
		    <?= __('vorläufiges Passwort') ?>: {{{$password}}}
		    </p>
		</div>
	</body>
</html>
