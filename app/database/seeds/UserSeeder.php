<?php
/**
 * @created 29.10.14 - 10:36
 * @author stefanriedel
 */

class UserSeeder extends Seeder {

	public function run()
	{
		DB::table('groups')->truncate();
		DB::table('users')->truncate();
		DB::table('users_groups')->truncate();

		$oAdminGroup = Sentry::createGroup(array(
			'name'        => 'Admin',
			'permissions' => array(
				'superuser' => 1
			),
		));

		Sentry::createGroup(array(
			'name' => 'Entwickler',
			'permissions' => array()
		));

		Sentry::createGroup(array(
			'name' => 'Grafiker',
			'permissions' => array()
		));

		Sentry::createGroup(array(
			'name' => 'Reporter',
			'permissions' => array()
		));

		$oUser = Sentry::createUser(array(
			'email'     => 'sr@alphabytes.de',
			'password'  => '1234',
			'activated' => true,
		));

		$oUser->addGroup($oAdminGroup);

	}

}